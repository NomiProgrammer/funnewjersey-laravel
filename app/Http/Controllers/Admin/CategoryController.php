<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    // List all categories
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Category::orderBy('id', 'desc')
            ->select([
                'id',
                'title',
                'not_public',
                'islink',
                'parent',
                'featured_img',
                'fa_icon'
            ]);

        return DataTables::of($data)
            ->editColumn('not_public', function ($item) {
                return $item->not_public == 1 ? 'Private' : 'Public';
            })
            ->editColumn('islink', function ($item) {
                return $item->islink == 1 ? 'Hardlink Category' : 'Normal';
            })
            ->editColumn('featured_img', function ($item) {
                $url = asset('front_assets/uploads/category/' . $item->featured_img);
                return '<img src="' . $url . '" alt="Image" width="80" height="50" loading="lazy">';
            })
->editColumn('fa_icon', function ($item) {
    return '<i class="' . $item->fa_icon . '"></i>';
})

            ->addColumn('actions', function ($item) {
                return '
                <div class="dropdown">
                    <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="actionDropdown' . $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cog"></i> Actions
                    </button>
                    <div class="dropdown-menu" aria-labelledby="actionDropdown' . $item->id . '">
                        <a class="dropdown-item" href="#"><i class="fas fa-edit text-dark"></i> &nbsp;Edit</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-trash text-dark"></i> &nbsp;Delete</a>
                    </div>
                </div>
                ';
            })
            ->rawColumns(['featured_img', 'fa_icon', 'actions'])
            ->make(true);
    }

    return view('dashboard.admin.category.index');
}



    // Show a single category
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    // Store a new category (demo data)
    public function store(Request $request)
    {
        $category = Category::create([
            'name' => 'Demo Category',
            'description' => 'This is a demo category.',
        ]);
        return response()->json($category);
    }

    // Update a category (demo data)
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'name' => 'Updated Category',
            'description' => 'This is an updated category.',
        ]);
        return response()->json($category);
    }

    // Delete a category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(['message' => 'Category deleted']);
    }
}
