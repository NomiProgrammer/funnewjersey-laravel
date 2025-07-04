<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MegaMenusTags;
use Yajra\DataTables\DataTables;

class MegaMenusTagsController extends Controller
{
    // List all mega menu tags
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = MegaMenusTags::select([
            'id',
            'category',
            'county',
            'city',
            'region',
            'h1',
            'metatitle',
            'metadesc',
            'metakeywords'
        ]);

        return datatables()->of($data)->make(true);
    }

    return view('dashboard.admin.meta_tags.index');
}

    // Show a single mega menu tag
    public function show($id)
    {
        $tag = MegaMenusTags::findOrFail($id);
        return response()->json($tag);
    }

    // Store a new mega menu tag (demo data)
    public function store(Request $request)
    {
        $tag = MegaMenusTags::create([
            'name' => 'Demo Tag',
            'description' => 'This is a demo mega menu tag.',
        ]);
        return response()->json($tag);
    }

    // Update a mega menu tag (demo data)
    public function update(Request $request, $id)
    {
        $tag = MegaMenusTags::findOrFail($id);
        $tag->update([
            'name' => 'Updated Tag',
            'description' => 'This is an updated mega menu tag.',
        ]);
        return response()->json($tag);
    }

    // Delete a mega menu tag
    public function destroy($id)
    {
        $tag = MegaMenusTags::findOrFail($id);
        $tag->delete();
        return response()->json(['message' => 'Mega menu tag deleted']);
    }
}
