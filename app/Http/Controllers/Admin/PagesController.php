<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pages;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PagesController extends Controller
{
    // List all pages
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Pages::select(['id', 'title', 'content', 'status']);

        return datatables()->of($data)
            ->addColumn('content', function ($row) {
                return Str::limit(strip_tags($row->content), 50);
            })
            ->make(true);
    }

    return view('dashboard.admin.pages_menu.index');
}

    // Show a single page
    public function show($id)
    {
        $page = Pages::findOrFail($id);
        return response()->json($page);
    }

    // Store a new page (demo data)
    public function store(Request $request)
    {
        $page = Pages::create([
            'title' => 'Demo Page',
            'content' => 'This is a demo page.',
        ]);
        return response()->json($page);
    }

    // Update a page (demo data)
    public function update(Request $request, $id)
    {
        $page = Pages::findOrFail($id);
        $page->update([
            'title' => 'Updated Page',
            'content' => 'This is an updated page.',
        ]);
        return response()->json($page);
    }

    // Delete a page
    public function destroy($id)
    {
        $page = Pages::findOrFail($id);
        $page->delete();
        return response()->json(['message' => 'Page deleted']);
    }
}
