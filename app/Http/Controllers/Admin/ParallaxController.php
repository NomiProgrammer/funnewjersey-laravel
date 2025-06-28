<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parallax;

class ParallaxController extends Controller
{
    // List all parallax sliders
    public function index()
    {
        $parallax = Parallax::all();
        return response()->json($parallax);
    }

    // Show a single parallax slider
    public function show($id)
    {
        $item = Parallax::findOrFail($id);
        return response()->json($item);
    }

    // Store a new parallax slider (demo data)
    public function store(Request $request)
    {
        $item = Parallax::create([
            'title' => 'Demo Parallax',
            'image' => 'parallax.jpg',
        ]);
        return response()->json($item);
    }

    // Update a parallax slider (demo data)
    public function update(Request $request, $id)
    {
        $item = Parallax::findOrFail($id);
        $item->update([
            'title' => 'Updated Parallax',
            'image' => 'updated.jpg',
        ]);
        return response()->json($item);
    }

    // Delete a parallax slider
    public function destroy($id)
    {
        $item = Parallax::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Parallax slider deleted']);
    }
}
