<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MegaMenus;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class MegaMenusController extends Controller
{
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = MegaMenus::select(['id', 'title']); // Only fetch 'id' and 'title'

        return datatables()->of($data)
            ->editColumn('title', function ($row) {
                return $row->title ?? '-';
            })
            ->addColumn('actions', function ($item) {
                $editUrl = route('mega_menus.edit', ['locale' => app()->getLocale(), 'id' => $item->id]);
                return '
                    <div class="dropdown">
                        <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="actionDropdown' . $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cog"></i> Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="actionDropdown' . $item->id . '">
                            <a class="dropdown-item" href="' . $editUrl . '">
                                <i class="fas fa-edit"></i> &nbsp;Edit
                            </a>
                            <a class="dropdown-item text-danger delete-mega" href="javascript:void(0);" data-id="' . $item->id . '">
                                <i class="fas fa-trash"></i> &nbsp;Delete
                            </a>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    return view('dashboard.admin.mega_menus.index');
}



    public function create()
    {
        $categories = Category::all();
        return view('dashboard.admin.mega_menus.create',compact("categories"));
    }


public function store(Request $request)
{
    // Validate request
    $request->validate([
        'category' => 'required|exists:categories,id',
        'title'         => 'nullable|string',
        'col1'         => 'nullable|string',
        'col2'         => 'nullable|string',
        'col3'         => 'nullable|string',
        'col4'         => 'nullable|string',
        'featured_img' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',

        'col5'         => 'nullable|string',
        'col1a'        => 'nullable|string',
        'col2a'        => 'nullable|string',
        'featured_img2'=> 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',

        'col3a'        => 'nullable|string',
        'col4a'        => 'nullable|string',
        'col5a'        => 'nullable|string',
        'featured_img3'=> 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',

        'col6a'        => 'nullable|string',
        'col7a'        => 'nullable|string',
        'col8a'        => 'nullable|string',
        'featured_img4'=> 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
    ]);

    // Save image files
    $paths = [];
    foreach (['featured_img', 'featured_img2', 'featured_img3', 'featured_img4'] as $imgField) {
        if ($request->hasFile($imgField)) {
            $paths[$imgField] = $request->file($imgField)->store('uploads/mega_menus', 'public');
        } else {
            $paths[$imgField] = null;
        }
    }

    // Create Mega Menu record
    MegaMenus::create([
        'title'          => $request->title,
        'category'          => $request->category,
        'col1'          => $request->col1,
        'col2'          => $request->col2,
        'col3'          => $request->col3,
        'col4'          => $request->col4,
        'featured_img'  => $paths['featured_img'],

        'col5'          => $request->col5,
        'col1a'         => $request->col1a,
        'col2a'         => $request->col2a,
        'featured_img2' => $paths['featured_img2'],

        'col3a'         => $request->col3a,
        'col4a'         => $request->col4a,
        'col5a'         => $request->col5a,
        'featured_img3' => $paths['featured_img3'],

        'col6a'         => $request->col6a,
        'col7a'         => $request->col7a,
        'col8a'         => $request->col8a,
        'featured_img4' => $paths['featured_img4'],
    ]);

    return redirect()->route('mega_menus.index')->with('success', 'Mega Menu created successfully.');
}


    public function edit($locale, $id)
    {
        $categories = Category::all();
        $menu = MegaMenus::findOrFail($id);
        return view('dashboard.admin.mega_menus.edit', compact('menu','categories'));
    }

public function update(Request $request, $locale, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'featured_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        'featured_img2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        'featured_img3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        'featured_img4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
    ]);

    $menu = MegaMenus::findOrFail($id);

    $menu->title = $request->title;
    $menu->col1 = $request->col1;
    $menu->col2 = $request->col2;
    $menu->col3 = $request->col3;
    $menu->col4 = $request->col4;
    $menu->col5 = $request->col5;
    $menu->col1a = $request->col1a;
    $menu->col2a = $request->col2a;
    $menu->col3a = $request->col3a;
    $menu->col4a = $request->col4a;
    $menu->col5a = $request->col5a;
    $menu->col6a = $request->col6a;
    $menu->col7a = $request->col7a;
    $menu->col8a = $request->col8a;

    // Handle file uploads
    if ($request->hasFile('featured_img')) {
        $menu->featured_img = $request->file('featured_img')->store('front_assets/uploads/menu', 'public');
    }
    if ($request->hasFile('featured_img2')) {
        $menu->featured_img2 = $request->file('featured_img2')->store('front_assets/uploads/menu', 'public');
    }
    if ($request->hasFile('featured_img3')) {
        $menu->featured_img3 = $request->file('featured_img3')->store('front_assets/uploads/menu', 'public');
    }
    if ($request->hasFile('featured_img4')) {
        $menu->featured_img4 = $request->file('featured_img4')->store('front_assets/uploads/menu', 'public');
    }

    $menu->save();

    return redirect()->route('mega_menus.index')->with('success', 'Menu updated successfully!');
}


    public function destroy($locale, $id)
    {
        $deals = MegaMenus::findOrFail($id);
        $deals->delete();

        return response()->json(['success' => 'Deals deleted successfully!']);
    }
}
