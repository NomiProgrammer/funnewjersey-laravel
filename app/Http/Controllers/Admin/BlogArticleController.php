<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogArticle;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
class BlogArticleController extends Controller
{
    // List all blog articles
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = BlogArticle::select(['type', 'title', 'description', 'status']);

        return datatables()->of($data)
            ->editColumn('title', function ($row) {
                $title = json_decode($row->title, true);
                return $title['en'] ?? '-';
            })
            ->editColumn('description', function ($row) {
                return trim(Str::limit(strip_tags($row->description), 50));
            })
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge badge-success">Published</span>';
                } elseif ($row->status == 0) {
                    return '<span class="badge badge-danger">Unpublished</span>';
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
                </div>
                ';
            })
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    return view('dashboard.admin.blog.index');
}


    // Show a single blog article
    public function show($id)
    {
        $article = BlogArticle::findOrFail($id);
        return response()->json($article);
    }

    // Store a new blog article (demo data)
    public function store(Request $request)
    {
        $article = BlogArticle::create([
            'title' => 'Demo Blog',
            'content' => 'This is a demo blog post.',
        ]);
        return response()->json($article);
    }

    // Update a blog article (demo data)
    public function update(Request $request, $id)
    {
        $article = BlogArticle::findOrFail($id);
        $article->update([
            'title' => 'Updated Blog',
            'content' => 'This is an updated blog post.',
        ]);
        return response()->json($article);
    }

    // Delete a blog article
    public function destroy($id)
    {
        $article = BlogArticle::findOrFail($id);
        $article->delete();
        return response()->json(['message' => 'Blog article deleted']);
    }
}
