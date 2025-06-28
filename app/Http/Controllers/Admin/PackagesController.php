<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Packages;

class PackagesController extends Controller
{
    // List all packages
    public function index()
    {
        $packages = Packages::all();
        return response()->json($packages);
    }

    // Show a single package
    public function show($id)
    {
        $package = Packages::findOrFail($id);
        return response()->json($package);
    }

    // Store a new package (demo data)
    public function store(Request $request)
    {
        $package = Packages::create([
            'name' => 'Demo Package',
            'price' => 99.99,
        ]);
        return response()->json($package);
    }

    // Update a package (demo data)
    public function update(Request $request, $id)
    {
        $package = Packages::findOrFail($id);
        $package->update([
            'name' => 'Updated Package',
            'price' => 149.99,
        ]);
        return response()->json($package);
    }

    // Delete a package
    public function destroy($id)
    {
        $package = Packages::findOrFail($id);
        $package->delete();
        return response()->json(['message' => 'Package deleted']);
    }
}
