<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parallax;

class ParallaxController extends Controller
{
<<<<<<< HEAD
public function index(Request $request)
{
    if ($request->ajax()) {
$data = Parallax::select('*');
=======
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
>>>>>>> 9bfae9b752cdeb3ad35c75119937192c516c2772

            return DataTables::of($data)->make(true);
        }

        return view('dashboard.admin.parallaxslider.index');
    }
}
