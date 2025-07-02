<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parallax;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;

class ParallaxController extends Controller
{
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Parallax::orderBy('id', 'desc')
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

    return view('dashboard.admin.parallaxslider.index');
}



}
