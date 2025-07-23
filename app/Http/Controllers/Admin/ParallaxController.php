<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parallax;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Locations;
use Illuminate\Support\Str;
class ParallaxController extends Controller
{
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Parallax::with(['categoryid', 'customer'])->orderBy('id', 'desc')
            ->select([
                'id',
                'featured_img',
                'title',
                'description',
                'slide_order',
                'created_by',
                'create_time',
                'status',
                'category',
                'starts',
                'expires',
            ]);

     return DataTables::of($data)
    ->editColumn('featured_img', function ($item) {
        $url = asset('front_assets/uploads/slider/' . $item->featured_img);
        return '<img src="' . $url . '" alt="Image" width="90" height="60" loading="lazy">';
    })
->addColumn('customer', function ($item) {
    return $item->customer
        ? trim($item->customer->first_name . ' ' . $item->customer->last_name)
        : '-';
})
->addColumn('category', function ($item) {
    return $item->categoryid ? $item->categoryid->title : '-';
})
    ->editColumn('description', function ($item) {
        return strlen($item->description) > 10 ? substr($item->description, 0, 10) . '...' : $item->description;
    })
                ->editColumn('expires', function ($item) {
    return \Carbon\Carbon::parse($item->expires)->format('d M Y');
})
                ->editColumn('starts', function ($item) {
    return \Carbon\Carbon::parse($item->starts)->format('d M Y');
})

    ->editColumn('status', function ($item) {
        if ($item->status == 1) {
            return '<span class="badge badge-success">Published</span>';
        } elseif ($item->status == 0) {
            return '<span class="badge badge-danger">Unpublished</span>';
        } elseif ($item->status == 2) {
            return '<span class="badge badge-warning">Drafted</span>';
        }
        return '<span class="badge badge-dark">Unknown</span>';
    })
->addColumn('actions', function ($item) {
  $editUrl = route('parallax.edit', ['locale' => app()->getLocale(), 'id' => $item->id]);
    return '
        <div class="dropdown">
            <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="actionDropdown' . $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cog"></i> Actions
            </button>
            <div class="dropdown-menu" aria-labelledby="actionDropdown' . $item->id . '">
                <a class="dropdown-item" href="' . $editUrl . '">
                    <i class="fas fa-edit"></i> &nbsp;Edit
                </a>
                <a class="dropdown-item text-danger delete-parallax" href="javascript:void(0);" data-id="' . $item->id . '">
                    <i class="fas fa-trash"></i> &nbsp;Delete
                </a>
            </div>
        </div>
    ';
})


    ->rawColumns(['featured_img', 'status', 'actions'])
    ->make(true);

    }

    return view('dashboard.admin.parallaxslider.index');
}

public function create()
{
    $categories = Category::all();
    $locations = Locations::all();
    $users = User::all();

    return view('dashboard.admin.parallaxslider.create', compact('categories', 'locations', 'users'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'link' => 'nullable|url',
        'alttag' => 'nullable|string|max:255',
        'button' => 'nullable|string|max:255',
        'starts' => 'nullable|date',
        'expires' => 'nullable|date|after_or_equal:starts',
        'category' => 'nullable|exists:categories,id',
        'county' => 'nullable|exists:locations,id',
        'city' => 'nullable|exists:locations,id',
        'description' => 'nullable|string',
        'created_by' => 'required|exists:users,id',
        'slide_order' => 'nullable|integer',
        'featured_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $validated;
    $data['create_time'] = time(); // Add UNIX timestamp

    if ($request->hasFile('featured_img')) {
        $image = $request->file('featured_img');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('front_assets/uploads/slider/'), $imageName);
        $data['featured_img'] = 'front_assets/uploads/slider/' . $imageName;
    }

    Parallax::create($data);

    return redirect()->route('parallax.index')->with('success', 'Parallax created successfully!');
}


public function edit($locale, $id)
{
    $parallax = Parallax::findOrFail($id);
    $categories = Category::all();
    $locations = Locations::all();
    $users = User::all();

    return view('dashboard.admin.parallaxslider.edit', compact('parallax', 'categories', 'locations', 'users'));
}

public function update(Request $request,  $locale,$id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'link' => 'nullable|url',
        'alttag' => 'nullable|string|max:255',
        'button' => 'nullable|string|max:255',
        'starts' => 'nullable|date',
        'expires' => 'nullable|date|after_or_equal:starts',
        'category' => 'nullable|exists:categories,id',
        'county' => 'nullable|exists:locations,id',
        'city' => 'nullable|exists:locations,id',
        'description' => 'nullable|string',
        'created_by' => 'required|exists:users,id',
        'slide_order' => 'nullable|integer',
        'featured_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $parallax = Parallax::findOrFail($id);
    $data = $request->all();

    if ($request->hasFile('featured_img')) {
        $image = $request->file('featured_img');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('front_assets/uploads/slider/'), $imageName);
        $data['featured_img'] = 'front_assets/uploads/slider/' . $imageName;
    }

    $parallax->update($data);

    return redirect()->route('parallax.index')->with('success', 'Parallax updated successfully!');
}

public function destroy($locale,$id)
{
    $parallax = Parallax::findOrFail($id);
    $parallax->delete();

    return response()->json(['success' => 'Parallax deleted successfully!']);
}

}
