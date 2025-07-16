<?php

namespace App\Http\Controllers\Admin;

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
        $data = MegaMenusTags::with(['categoryid','location'])->orderBy('id', 'asc')->select([
            'category',
            'county',
            'city',
            'region',
            'h1',
            'metatitle',
            'metadesc',
            'metakeywords'
        ]);

        return datatables()->of($data)
                    ->addColumn('category', function ($item) {
    return $item->categoryid ? $item->categoryid->title : '-';
})
            ->addColumn('location', function ($item) {
    return $item->location ? $item->location->name : '-';
})
            ->addColumn('actions', function ($item) {
                return '
                    <div class="dropdown">
                        <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="actionDropdown' . $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cog"></i> Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="actionDropdown' . $item->id . '">
                            <a class="dropdown-item" href="#"><i class="fas fa-edit"></i> &nbsp;Edit</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-trash"></i> &nbsp;Delete</a>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
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
