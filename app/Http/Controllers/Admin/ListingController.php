<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listings;
use Yajra\DataTables\DataTables;

class ListingController extends Controller
{
    // List all listings
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Listings::orderBy('id', 'desc')->select([
            'featured_img',
            'title',
            'category',
            'email',
            'city',
            'status',
            'expirtion_date',
            'featured'
        ]);

        return datatables()->of($data)
            ->editColumn('featured_img', function ($item) {
                $url = asset('front_assets/uploads/listings/' . $item->featured_img);
                return '<img src="' . $url . '" alt="Image" width="90" height="60" loading="lazy">';
            })
            ->addColumn('days_left', function ($row) {
                if ($row->expirtion_date) {
                    $days = \Carbon\Carbon::parse($row->expirtion_date)->diffInDays(now());
                    return $days . ' days';
                }
                return 'N/A';
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
                        <a class="dropdown-item" href="#"><i class="fas fa-edit text-dark"></i> &nbsp;Edit</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-star text-dark"></i> &nbsp;View All Reviews</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-trash text-dark"></i> &nbsp;Trash Post</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-certificate text-dark"></i> &nbsp;Make Featured</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-redo text-dark"></i> &nbsp;Renew Package</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-eye text-dark"></i> &nbsp;View Listing</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-copy text-dark"></i> &nbsp;Duplicate Listing</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-check text-dark"></i> &nbsp;Activate Listing</a>
                    </div>
                </div>
                ';
            })
            ->rawColumns(['featured_img', 'status', 'actions'])
            ->make(true);
    }

    return view('dashboard.admin.listings.index');
}


    // Show a single listing
    public function show($id)
    {
        $listing = Listings::findOrFail($id);
        return response()->json($listing);
    }

    // Store a new listing (demo data)
    public function store(Request $request)
    {
        $listing = Listings::create([
            'title' => 'Demo Listing',
            'description' => 'This is a demo listing.',
        ]);
        return response()->json($listing);
    }

    // Update a listing (demo data)
    public function update(Request $request, $id)
    {
        $listing = Listings::findOrFail($id);
        $listing->update([
            'title' => 'Updated Listing',
            'description' => 'This is an updated listing.',
        ]);
        return response()->json($listing);
    }

    // Delete a listing
    public function destroy($id)
    {
        $listing = Listings::findOrFail($id);
        $listing->delete();
        return response()->json(['message' => 'Listing deleted']);
    }
}
