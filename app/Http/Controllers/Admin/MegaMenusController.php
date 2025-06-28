<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MegaMenus;

class MegaMenusController extends Controller
{
    // List all mega menus
    public function index()
    {
        $menus = MegaMenus::all();
        return response()->json($menus);
    }

    // Show a single mega menu
    public function show($id)
    {
        $menu = MegaMenus::findOrFail($id);
        return response()->json($menu);
    }

    // Store a new mega menu (demo data)
    public function store(Request $request)
    {
        $menu = MegaMenus::create([
            'name' => 'Demo Menu',
            'description' => 'This is a demo mega menu.',
        ]);
        return response()->json($menu);
    }

    // Update a mega menu (demo data)
    public function update(Request $request, $id)
    {
        $menu = MegaMenus::findOrFail($id);
        $menu->update([
            'name' => 'Updated Menu',
            'description' => 'This is an updated mega menu.',
        ]);
        return response()->json($menu);
    }

    // Delete a mega menu
    public function destroy($id)
    {
        $menu = MegaMenus::findOrFail($id);
        $menu->delete();
        return response()->json(['message' => 'Mega menu deleted']);
    }
}
