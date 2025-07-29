<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogArticle;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
class BlogArticleController extends Controller
{
    // List all blog articles
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = BlogArticle::select(['id','type', 'title', 'description', 'status']);

        return datatables()->of($data)
->editColumn('description', function ($item) {
    $cleanText = strip_tags($item->description); // remove HTML
    return strlen($cleanText) > 10 ? substr($cleanText, 0, 10) . '...' : $cleanText;
})
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge badge-success">Published</span>';
                } elseif ($row->status == 0) {
                    return '<span class="badge badge-danger">Unpublished</span>';
                } elseif ($row->status == 2) {
                    return '<span class="badge badge-warning">Drafted</span>';
                } else {
                    return '<span class="badge badge-secondary">Unknown</span>';
                }
            })
->addColumn('actions', function ($item) {
  $editUrl = route('blog.edit', ['locale' => app()->getLocale(), 'id' => $item->id]);
    return '
        <div class="dropdown">
            <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="actionDropdown' . $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cog"></i> Actions
            </button>
            <div class="dropdown-menu" aria-labelledby="actionDropdown' . $item->id . '">
                <a class="dropdown-item" href="' . $editUrl . '">
                    <i class="fas fa-edit"></i> &nbsp;Edit
                </a>
                <a class="dropdown-item text-danger delete-blogdelete" href="javascript:void(0);" data-id="' . $item->id . '">
                    <i class="fas fa-trash"></i> &nbsp;Delete
                </a>
            </div>
        </div>
    ';
})
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    return view('dashboard.admin.blog.index');
}
public function trashIndex(Request $request)
{
    if ($request->ajax()) {
        $data = BlogArticle::onlyTrashed()->select(['id', 'type', 'title', 'description', 'status']);

        return datatables()->of($data)
            ->editColumn('title', function ($row) {
                $title = json_decode($row->title, true);
                return $title['en'] ?? '-';
            })
            ->editColumn('description', function ($item) {
                $cleanText = strip_tags($item->description);
                return strlen($cleanText) > 10 ? substr($cleanText, 0, 10) . '...' : $cleanText;
            })
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge badge-success">Published</span>';
                } elseif ($row->status == 0) {
                    return '<span class="badge badge-danger">Unpublished</span>';
                } elseif ($row->status == 2) {
                    return '<span class="badge badge-warning">Drafted</span>';
                } else {
                    return '<span class="badge badge-secondary">Unknown</span>';
                }
            })
            ->addColumn('actions', function ($item) {
                $restoreUrl = route('blog.restore', ['id' => $item->id]);
                $forceDeleteUrl = route('blog.forceDelete', ['id' => $item->id]);

                return '
                    <div class="dropdown">
                        <button class="btn btn-sm btn-warning dropdown-toggle" type="button" id="trashActionDropdown' . $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-tools"></i> Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="trashActionDropdown' . $item->id . '">
                            <a class="dropdown-item text-success restore-blog" href="javascript:void(0);" data-id="' . $item->id . '" data-url="' . $restoreUrl . '">
                                <i class="fas fa-undo"></i> &nbsp;Restore
                            </a>
                            <a class="dropdown-item text-danger force-delete-blog" href="javascript:void(0);" data-id="' . $item->id . '" data-url="' . $forceDeleteUrl . '">
                                <i class="fas fa-times-circle"></i> &nbsp;Delete Permanently
                            </a>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    return view('dashboard.admin.blog.trash');
}

public function restore( $locale, $id)
{
    $article = BlogArticle::withTrashed()->findOrFail($id);
    $article->restore();

       return response()->json(['success' => 'Blog article Restore successfully!']);

}

public function forceDelete( $locale, $id)
{
    $article = BlogArticle::withTrashed()->findOrFail($id);
    $article->forceDelete();

        return response()->json(['success' => 'Blog article deleted successfully!']);

}

  public function create()
{
    $categories = Category::all();

    return view('dashboard.admin.blog.create', compact('categories'));
}

public function store(Request $request)
{
    $request->validate([
        'type' => 'required|in:blog,article,news,product,deal',
        'category' => 'nullable|exists:categories,id',
        'title' => 'required|string|max:255',
        'bmetatitle' => 'nullable|string|max:255',
        'bmetadescription' => 'nullable|string|max:500',
        'pageh1' => 'nullable|string|max:255',
        'price' => 'nullable|numeric',
        'shipping' => 'nullable|numeric',
        'description' => 'nullable|string',
        'featured_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->all();
    // Add authenticated user ID
    $data['title'] = json_encode(['en' => $data['title']]);
    $data['description'] = json_encode(['en' => $data['description'] ?? '']);
    $data['created_by'] = Auth::id();
    $data['create_time'] = time(); // Add UNIX timestamp

    if ($request->hasFile('featured_img')) {
        $image = $request->file('featured_img');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('front_assets/uploads/blog/'), $imageName);
        $data['featured_img'] = 'front_assets/uploads/blog/' . $imageName;
    }

    BlogArticle::create($data);

    return redirect()->route('blog.index')->with('success', 'Blog article created successfully!');
}

public function edit($locale, $id)
{
    $blog = BlogArticle::findOrFail($id);
    $categories = Category::all();

    return view('dashboard.admin.blog.edit', compact('blog', 'categories'));
}

public function update(Request $request, $locale, $id)
{
    $request->validate([
        'type' => 'required|in:blog,article,news,product,deal',
        'category' => 'nullable|exists:categories,id',
        'title' => 'required|string|max:255',
        'bmetatitle' => 'nullable|string|max:255',
        'bmetadescription' => 'nullable|string|max:500',
        'pageh1' => 'nullable|string|max:255',
        'price' => 'nullable|numeric',
        'shipping' => 'nullable|numeric',
        'description' => 'nullable|string',
        'featured_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $blog = BlogArticle::findOrFail($id);
    $data = $request->all();
    $data['title'] = json_encode(['en' => $data['title']]);
    $data['description'] = json_encode(['en' => $data['description'] ?? '']);
    if ($request->hasFile('featured_img')) {
        $image = $request->file('featured_img');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('front_assets/uploads/blog/'), $imageName);
        $data['featured_img'] = 'front_assets/uploads/blog/' . $imageName;
    }

    $blog->update($data);

    return redirect()->route('blog.index')->with('success', 'Blog article updated successfully!');
}

public function destroy($locale, $id)
{
    $blog = BlogArticle::findOrFail($id);
    $blog->delete();

    return response()->json(['success' => 'Blog article deleted successfully!']);
}
}
