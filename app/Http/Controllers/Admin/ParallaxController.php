<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        return DataTables::of($data)->make(true);
    }

    return view('dashboard.admin.parallaxslider.index');
}

}
