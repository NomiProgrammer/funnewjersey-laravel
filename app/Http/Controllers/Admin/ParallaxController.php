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

            $data = Parallax::select([
                'id',
                'slide_order',
                'featured_img',
                'title',
                'description',
                'created_by',
                'create_time',
                'status',
                'category',
                'link',
                'alttag',
                'button',
                'expires',
                'starts',
                'city',
                'county',
            ]);

            return DataTables::of($data)->editColumn('featured_img', function ($item) {
                $url = asset('front_assets/uploads/slider/' . $item->featured_img); // or your path
                return '<img src="' . $url . '" alt="Image" width="90" height="60" loading="lazy">';
            })
                ->rawColumns(['featured_img'])->make(true);
        }

        return view('dashboard.admin.parallaxslider.index');
    }
}
