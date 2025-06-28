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
        $data = Category::select([
            'id',
            'title',
            'not_public',
            'islink',
            'parent',
            'featured_img',
            'fa_icon'
        ]);

        return DataTables::of($data)->make(true);
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
