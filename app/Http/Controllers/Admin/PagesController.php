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
        $data = Pages::select(['title', 'content', 'status']);

        return datatables()->of($data)
            ->editColumn('content', function ($row) {
                return Str::limit(strip_tags($row->content), 50);
            })
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge badge-success">Published</span>';
                } elseif ($row->status == 2) {
                    return '<span class="badge badge-warning">Drafted</span>';
                } else {
                    return '<span class="badge badge-secondary">Unknown</span>';
                }
            })
            ->addColumn('actions', function ($row) {
                return '
                <div class="dropdown">
                    <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="actionDropdown' . $row->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cog"></i> Actions
                    </button>
                    <div class="dropdown-menu" aria-labelledby="actionDropdown' . $row->id . '">
                        <a class="dropdown-item" href="#"><i class="fas fa-edit text-dark"></i> &nbsp;Edit</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-trash text-dark"></i> &nbsp;Delete</a>
                    </div>
                </div>';
            })
            ->rawColumns(['status', 'actions'])
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
