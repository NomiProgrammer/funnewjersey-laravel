<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listings;

class ListingController extends Controller
{
    // List all listings
    public function index()
    {
        $listings = Listings::all();
        return response()->json($listings);
    }

    // Show a single listing
    public function show($id)
    {
        $listing = Listings::findOrFail($id);
        return response()->json($listing);
    }

    // Store a new listing (demo data)
    public function store(Request $request)
    {
        $listing = Listings::create([
            'title' => 'Demo Listing',
            'description' => 'This is a demo listing.',
        ]);
        return response()->json($listing);
    }

    // Update a listing (demo data)
    public function update(Request $request, $id)
    {
        $listing = Listings::findOrFail($id);
        $listing->update([
            'title' => 'Updated Listing',
            'description' => 'This is an updated listing.',
        ]);
        return response()->json($listing);
    }

    // Delete a listing
    public function destroy($id)
    {
        $listing = Listings::findOrFail($id);
        $listing->delete();
        return response()->json(['message' => 'Listing deleted']);
    }
}
