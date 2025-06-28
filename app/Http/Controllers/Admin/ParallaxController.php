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
            // dd("ASdfd");
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
            return DataTables::of($data)->make(true);
        }

        return view('dashboard.admin.parallaxslider.index');
    }
}
