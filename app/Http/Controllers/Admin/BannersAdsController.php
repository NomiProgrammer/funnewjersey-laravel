<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BannersAds;
use App\Models\Category;
use App\Models\User;
use App\Models\Locations;
use Yajra\DataTables\DataTables;

class BannersAdsController extends Controller
{
    // List all banner ads
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = BannersAds::with(['categoryid', 'customer', 'location'])->orderBy('id', 'asc')->select([
                'id',
                'featured_img',
                'title',
                'description',
                'slot',
                'type',
                'category',
                'state',
                'created_by',
                'expires',
                'status',
            ]);

            return DataTables::of($data)
                ->editColumn('featured_img', function ($item) {
                    $url = asset($item->featured_img);
                    return '<img src="' . $url . '" alt="Image" width="90" height="60" loading="lazy">';
                })

->editColumn('description', function ($item) {
    $cleanText = strip_tags($item->description); // remove HTML
    return strlen($cleanText) > 10 ? substr($cleanText, 0, 10) . '...' : $cleanText;
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
                ->editColumn('type', function ($item) {
                    if ($item->type == 1) {
                        return '<span class="badge badge-success">Top Horizontal</span>';
                    } elseif ($item->type == 2) {
                        return '<span class="badge badge-danger">Sidebar Square</span>';
                    }
                    return '<span class="badge badge-dark">Unknown</span>';
                })
                ->addColumn('category', function ($item) {
                    return $item->categoryid ? $item->categoryid->title : '-';
                })
                ->addColumn('location', function ($item) {
                    return $item->location ? $item->location->name : '-';
                })
                ->addColumn('customer', function ($item) {
                    return $item->customer
                        ? trim($item->customer->first_name . ' ' . $item->customer->last_name)
                        : '-';
                })
                ->addColumn('actions', function ($item) {
                    $editUrl = route('banners-ads.edit', ['locale' => app()->getLocale(), 'id' => $item->id]);
                    return '
        <div class="dropdown">
            <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="actionDropdown' . $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cog"></i> Actions
            </button>
            <div class="dropdown-menu" aria-labelledby="actionDropdown' . $item->id . '">
                <a class="dropdown-item" href="' . $editUrl . '">
                    <i class="fas fa-edit"></i> &nbsp;Edit
                </a>
                <a class="dropdown-item text-danger delete-banner" href="javascript:void(0);" data-id="' . $item->id . '">
                    <i class="fas fa-trash"></i> &nbsp;Delete
                </a>
            </div>
        </div>
    ';
                })
                ->rawColumns(['featured_img', 'status', 'actions','type'])
                ->make(true);
        }

        return view('dashboard.admin.bannersads.index');
    }




    // Show a single banner ad
    public function show($id)
    {
        $banner = BannersAds::findOrFail($id);
        return response()->json($banner);
    }

    public function create()
    {
        $categories = Category::all();
        $users = User::all();
        $states = Locations::all();

        return view('dashboard.admin.bannersads.create', compact('categories', 'users', 'states'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'slide_order' => 'required|integer',
            'featured_img' => 'required|image',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'created_by' => 'required|exists:users,id',
            'status' => 'required|in:0,1,2',
            'state' => 'required|exists:locations,id',
            'link' => 'nullable|url',
            'slot' => 'nullable|string|max:255',
            'category' => 'required|exists:categories,id',
            'expires' => 'nullable|date',
            'assigned_to' => 'nullable|exists:users,id',
            'type' => 'required|in:0,1,2',
            'region' => 'required|in:1,2,3',
        ]);

        // ✅ 2) Handle the image upload
        if ($request->hasFile('featured_img')) {
            $image = $request->file('featured_img');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Store in /public/front_assets/uploads/banner
            $image->move(public_path('front_assets/uploads/banner'), $imageName);

            // Save relative path for asset()
            $path = 'front_assets/uploads/banner/' . $imageName;
        } else {
            $path = null;
        }


        BannersAds::create([
            'slide_order' => $request->slide_order,
            'featured_img' => $path,
            'title' => $request->title,
            'description' => $request->description,
            'created_by' => $request->created_by,
            'create_time' => time(),
            'status' => $request->status,
            'state' => $request->state,
            'link' => $request->link,
            'slot' => $request->slot,
            'category' => $request->category,
            'expires' => $request->expires,
            'assigned_to' => $request->assigned_to,
            'type' => $request->type,
            'region' => $request->region,
        ]);

        return redirect()->route('bannersads.index')->with('success', 'Banner Ad created successfully!');
    }

    public function edit($locale, $id)
    {
        $banner = BannersAds::findOrFail($id);
        $categories = Category::all();
        $users = User::all();
        $states = Locations::all();

        return view('dashboard.admin.bannersads.edit', compact('banner', 'categories', 'users', 'states'));
    }

    public function update(Request $request, $locale, $id)
    {
        $request->validate([
            'slide_order' => 'required|integer',
            'featured_img' => 'nullable|image',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'created_by' => 'required|exists:users,id',
            'status' => 'required|in:0,1,2',
            'state' => 'required|exists:locations,id',
            'link' => 'nullable|url',
            'slot' => 'nullable|string|max:255',
            'category' => 'required|exists:categories,id',
            'expires' => 'nullable|date',
            'assigned_to' => 'nullable|exists:users,id',
            'type' => 'required|in:0,1,2',
            'region' => 'required|in:1,2,3',
        ]);

        $banner = BannersAds::findOrFail($id);

        if ($request->hasFile('featured_img')) {
            $path = $request->file('featured_img')->store('front_assets/uploads/banner', 'public');
            $banner->featured_img = $path;
        }

        $banner->update([
            'slide_order' => $request->slide_order,
            'title' => $request->title,
            'description' => $request->description,
            'created_by' => $request->created_by,
            'status' => $request->status,
            'state' => $request->state,
            'link' => $request->link,
            'slot' => $request->slot,
            'category' => $request->category,
            'expires' => $request->expires,
            'assigned_to' => $request->assigned_to,
            'type' => $request->type,
            'region' => $request->region,
        ]);

        return redirect()->route('bannersads.index')->with('success', 'Banner Ad updated successfully!');
    }

    public function destroy($locale, $id)
    {
        $banner = BannersAds::findOrFail($id);
        $banner->delete();

        return response()->json(['success' => 'Banner Ad deleted successfully!']);
    }
}
