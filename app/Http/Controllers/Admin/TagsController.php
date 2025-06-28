<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tags;
use Yajra\DataTables\DataTables;

class TagsController extends Controller
{
    // List all tags
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Tags::select(['id', 'title']);
        return datatables()->of($data)->make(true);
    }

    return view('dashboard.admin.tags.index');
}


    // Show a single tag
    public function show($id)
    {
        $tag = Tags::findOrFail($id);
        return response()->json($tag);
    }

    // Store a new tag (demo data)
    public function store(Request $request)
    {
        $tag = Tags::create([
            'name' => 'Demo Tag',
        ]);
        return response()->json($tag);
    }

    // Update a tag (demo data)
    public function update(Request $request, $id)
    {
        $tag = Tags::findOrFail($id);
        $tag->update([
            'name' => 'Updated Tag',
        ]);
        return response()->json($tag);
    }

    // Delete a tag
    public function destroy($id)
    {
        $tag = Tags::findOrFail($id);
        $tag->delete();
        return response()->json(['message' => 'Tag deleted']);
    }
}
