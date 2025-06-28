<?php

namespace App\Http\Controllers\admin;

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
        $data = BlogArticle::select(['id', 'type', 'title', 'description', 'status']);

        return datatables()->of($data)
            ->addColumn('title', function ($row) {
                // Decode JSON and get 'en'
                $title = json_decode($row->title, true);
                return $title['en'] ?? '-';
            })
            ->addColumn('description', function ($row) {
                // Shorten description
                return Str::limit(strip_tags($row->description), 50);
            })
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
