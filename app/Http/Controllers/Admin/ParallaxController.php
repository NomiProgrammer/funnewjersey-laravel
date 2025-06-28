<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parallax;
class ParallaxController extends Controller
{
public function index(Request $request)
{
    if ($request->ajax()) {
$data = Parallax::select('*');

        return DataTables::of($data)->make(true);
    }

    return view('dashboard.admin.parallaxslider.index');
}

}
