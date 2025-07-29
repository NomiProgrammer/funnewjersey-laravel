<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    // List all categories
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Category::with(['parentCategory'])->orderBy('id', 'asc')
            ->select([
                'id',
                'title',
                'not_public',
                'islink',
                'parent',
                'featured_img',
                'fa_icon'
            ]);

        return DataTables::of($data)
            ->editColumn('not_public', function ($item) {
                return $item->not_public == 1 ? 'Private' : 'Public';
            })
            ->editColumn('islink', function ($item) {
                return $item->islink == 1 ? 'Hardlink Category' : 'Normal';
            })
            ->editColumn('featured_img', function ($item) {
                $url = asset('front_assets/uploads/category/' . $item->featured_img);
                return '<img src="' . $url . '" alt="Image" width="80" height="50" loading="lazy">';
            })
            ->addColumn('parentCategory', function ($row) {
                return $row->parentCategory ? $row->parentCategory->title : '-';
            })
->editColumn('fa_icon', function ($item) {
    return '<i class="fa ' . e($item->fa_icon) . '"></i>';
})
->addColumn('actions', function ($item) {
  $editUrl = route('category.edit', ['locale' => app()->getLocale(), 'id' => $item->id]);
    return '
        <div class="dropdown">
            <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="actionDropdown' . $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cog"></i> Actions
            </button>
            <div class="dropdown-menu" aria-labelledby="actionDropdown' . $item->id . '">
                <a class="dropdown-item" href="' . $editUrl . '">
                    <i class="fas fa-edit"></i> &nbsp;Edit
                </a>
                <a class="dropdown-item text-danger delete-category" href="javascript:void(0);" data-id="' . $item->id . '">
                    <i class="fas fa-trash"></i> &nbsp;Delete
                </a>
            </div>
        </div>
    ';
})
            ->rawColumns(['featured_img', 'fa_icon', 'actions','parentCategory'])
            ->make(true);
    }

    return view('dashboard.admin.category.index');
}

        public function create()
    {
        $parent = Category::all();
        return view('dashboard.admin.category.create',compact('parent'));
    }

    public function edit($locale, $id)
    {
        $category = Category::findOrFail($id);
         $parent = Category::where('id', '!=', $id)->get(); // Prevent setting itself as parent
        return view('dashboard.admin.category.edit', compact('category','parent'));
    }

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'minititle' => 'nullable|string|max:255',
        'url' => 'nullable|string|max:255',
        'not_public' => 'nullable|in:0,1',
        'noh1' => 'nullable|in:0,1',
        'islink' => 'nullable|in:0,1',
        'countoverride' => 'nullable|integer',
        'parent' => 'nullable|integer|exists:categories,id',
        'fa_icon' => 'nullable|string|max:255',
        'metatitle2' => 'nullable|string',
        'metakeywords2' => 'nullable|string',
        'metadescription2' => 'nullable|string',
        'catdesc' => 'nullable|string',
        'catdesc2' => 'nullable|string',
        'metatitle' => 'nullable|string',
        'metakeywords' => 'nullable|string',
        'metadescription' => 'nullable|string',
        'catdescvar' => 'nullable|string',
        'catdesc2var' => 'nullable|string',
        'featured_img' => 'nullable|image',
        'img_alt' => 'nullable|string|max:255',
        'featured_img2' => 'nullable|image',
        'img_alt2' => 'nullable|string|max:255',
        'featured_img3' => 'nullable|image',
        'img_alt3' => 'nullable|string|max:255',
    ]);

    // Image upload handling
    $featured_img = null;
    $featured_img2 = null;
    $featured_img3 = null;

    if ($request->hasFile('featured_img')) {
        $file = $request->file('featured_img');
        $featured_img = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('front_assets/uploads/catgoies'), $featured_img);
    }

    if ($request->hasFile('featured_img2')) {
        $file = $request->file('featured_img2');
        $featured_img2 = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('front_assets/uploads/catgoies'), $featured_img2);
    }

    if ($request->hasFile('featured_img3')) {
        $file = $request->file('featured_img3');
        $featured_img3 = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('front_assets/uploads/catgoies'), $featured_img3);
    }
$createTime = time();

    Category::create([
        'title' => $request->title,
        'minititle' => $request->minititle,
        'url' => $request->url,
        'not_public' => $request->not_public,
        'noh1' => $request->noh1,
        'islink' => $request->islink,
        'countoverride' => $request->countoverride,
        'parent' => $request->parent,
        'fa_icon' => $request->fa_icon,
        'metatitle2' => $request->metatitle2,
        'metakeywords2' => $request->metakeywords2,
        'metadescription2' => $request->metadescription2,
        'catdesc' => $request->catdesc,
        'catdesc2' => $request->catdesc2,
        'metatitle' => $request->metatitle,
        'metakeywords' => $request->metakeywords,
        'metadescription' => $request->metadescription,
        'catdescvar' => $request->catdescvar,
        'catdesc2var' => $request->catdesc2var,
        'featured_img' => $featured_img,
        'img_alt' => $request->img_alt,
        'featured_img2' => $featured_img2,
        'img_alt2' => $request->img_alt2,
        'featured_img3' => $featured_img3,
        'img_alt3' => $request->img_alt3,
        'created_by' => Auth::id(), // ✅ add this line
        'create_time' => time(), // UNIX timestamp

    ]);

    return redirect()->route('category.index')->with('success', 'Category created successfully!');
}


public function update(Request $request, $locale, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'minititle' => 'nullable|string|max:255',
        'url' => 'nullable|string|max:255',
        'not_public' => 'nullable|in:0,1',
        'noh1' => 'nullable|in:0,1',
        'islink' => 'nullable|in:0,1',
        'countoverride' => 'nullable|integer',
        'parent' => 'nullable|integer|exists:categories,id',
        'fa_icon' => 'nullable|string|max:255',
        'metatitle2' => 'nullable|string',
        'metakeywords2' => 'nullable|string',
        'metadescription2' => 'nullable|string',
        'catdesc' => 'nullable|string',
        'catdesc2' => 'nullable|string',
        'metatitle' => 'nullable|string',
        'metakeywords' => 'nullable|string',
        'metadescription' => 'nullable|string',
        'catdescvar' => 'nullable|string',
        'catdesc2var' => 'nullable|string',
        'featured_img' => 'nullable|image',
        'img_alt' => 'nullable|string|max:255',
        'featured_img2' => 'nullable|image',
        'img_alt2' => 'nullable|string|max:255',
        'featured_img3' => 'nullable|image',
        'img_alt3' => 'nullable|string|max:255',
    ]);

    $category = Category::findOrFail($id);

    // Image handling (replaces only if a new file is uploaded)
    $featured_img = $category->featured_img;
    $featured_img2 = $category->featured_img2;
    $featured_img3 = $category->featured_img3;

    if ($request->hasFile('featured_img')) {
        $file = $request->file('featured_img');
        $featured_img = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('front_assets/uploads/catgoies'), $featured_img);
    }

    if ($request->hasFile('featured_img2')) {
        $file = $request->file('featured_img2');
        $featured_img2 = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('front_assets/uploads/catgoies'), $featured_img2);
    }

    if ($request->hasFile('featured_img3')) {
        $file = $request->file('featured_img3');
        $featured_img3 = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('front_assets/uploads/catgoies'), $featured_img3);
    }

    $category->update([
        'title' => $request->title,
        'minititle' => $request->minititle,
        'url' => $request->url,
        'not_public' => $request->not_public,
        'noh1' => $request->noh1,
        'islink' => $request->islink,
        'countoverride' => $request->countoverride,
        'parent' => $request->parent,
        'fa_icon' => $request->fa_icon,
        'metatitle2' => $request->metatitle2,
        'metakeywords2' => $request->metakeywords2,
        'metadescription2' => $request->metadescription2,
        'catdesc' => $request->catdesc,
        'catdesc2' => $request->catdesc2,
        'metatitle' => $request->metatitle,
        'metakeywords' => $request->metakeywords,
        'metadescription' => $request->metadescription,
        'catdescvar' => $request->catdescvar,
        'catdesc2var' => $request->catdesc2var,
        'featured_img' => $featured_img,
        'img_alt' => $request->img_alt,
        'featured_img2' => $featured_img2,
        'img_alt2' => $request->img_alt2,
        'featured_img3' => $featured_img3,
        'img_alt3' => $request->img_alt3,
    ]);

    return redirect()->route('category.index')->with('success', 'Category updated successfully!');
}



    public function destroy($locale,$id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(['success' => 'Category deleted successfully!']);
    }



}
