<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BannersAds;
use Yajra\DataTables\DataTables;

class BannersAdsController extends Controller
{
    // List all banner ads
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = BannersAds::orderBy('id', 'desc')->select([
            'id',
            'featured_img',
            'title',
            'description',
            'slot',
            'type',
            'category',
            'region',
            'created_by',
            'expires',
            'status',
        ]);

        return DataTables::of($data)
            ->editColumn('featured_img', function ($item) {
                $url = asset('front_assets/uploads/banner/' . $item->featured_img);
                return '<img src="' . $url . '" alt="Image" width="90" height="60" loading="lazy">';
            })
                        ->editColumn('expires', function ($item) {
    return \Carbon\Carbon::parse($item->expires)->format('d M Y');
})
            ->editColumn('description', function ($item) {
                return $item->description
                    ? (strlen($item->description) > 10 ? substr($item->description, 0, 10) . '...' : $item->description)
                    : '-';
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
    return '
    <div class="dropdown">
        <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="actionDropdown' . $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i> Actions
        </button>
        <div class="dropdown-menu" aria-labelledby="actionDropdown' . $item->id . '">
            <a class="dropdown-item" href="#"><i class="fas fa-edit text-primary"></i> &nbsp;Edit</a>
            <a class="dropdown-item" href="#"><i class="fas fa-pause text-warning"></i> &nbsp;Pause</a>
            <a class="dropdown-item" href="#"><i class="fas fa-trash text-danger"></i> &nbsp;Delete</a>
        </div>
    </div>
    ';
})
            ->rawColumns(['featured_img', 'status', 'actions'])
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

    // Store a new banner ad (demo data)
    public function store(Request $request)
    {
        $banner = BannersAds::create([
            'title' => 'Demo Banner',
            'image' => 'demo.jpg',
            'link' => 'https://example.com',
        ]);
        return response()->json($banner);
    }

    // Update a banner ad (demo data)
    public function update(Request $request, $id)
    {
        $banner = BannersAds::findOrFail($id);
        $banner->update([
            'title' => 'Updated Banner',
            'image' => 'updated.jpg',
            'link' => 'https://updated.com',
        ]);
        return response()->json($banner);
    }

    // Delete a banner ad
    public function destroy($id)
    {
        $banner = BannersAds::findOrFail($id);
        $banner->delete();
        return response()->json(['message' => 'Banner deleted']);
    }
}
