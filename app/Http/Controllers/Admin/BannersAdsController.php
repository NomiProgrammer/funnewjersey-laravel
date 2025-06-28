<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BannersAds;

class BannersAdsController extends Controller
{
    // List all banner ads
    public function index()
    {
        $banners = BannersAds::all();
        return response()->json($banners);
    }

    // Show a single banner ad
    public function show($id)
    {
        $banner = BannersAds::findOrFail($id);
        return response()->json($banner);
    }

    // Store a new banner ad (demo data)
    public function store(Request $request)
    {
        $banner = BannersAds::create([
            'title' => 'Demo Banner',
            'image' => 'demo.jpg',
            'link' => 'https://example.com',
        ]);
        return response()->json($banner);
    }

    // Update a banner ad (demo data)
    public function update(Request $request, $id)
    {
        $banner = BannersAds::findOrFail($id);
        $banner->update([
            'title' => 'Updated Banner',
            'image' => 'updated.jpg',
            'link' => 'https://updated.com',
        ]);
        return response()->json($banner);
    }

    // Delete a banner ad
    public function destroy($id)
    {
        $banner = BannersAds::findOrFail($id);
        $banner->delete();
        return response()->json(['message' => 'Banner deleted']);
    }
}
