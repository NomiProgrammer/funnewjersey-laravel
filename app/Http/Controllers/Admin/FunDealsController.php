<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FunDeals;

class FunDealsController extends Controller
{
    // List all fun deals
    public function index()
    {
        $deals = FunDeals::all();
        return response()->json($deals);
    }

    // Show a single fun deal
    public function show($id)
    {
        $deal = FunDeals::findOrFail($id);
        return response()->json($deal);
    }

    // Store a new fun deal (demo data)
    public function store(Request $request)
    {
        $deal = FunDeals::create([
            'title' => 'Demo Deal',
            'description' => 'This is a demo fun deal.',
        ]);
        return response()->json($deal);
    }

    // Update a fun deal (demo data)
    public function update(Request $request, $id)
    {
        $deal = FunDeals::findOrFail($id);
        $deal->update([
            'title' => 'Updated Deal',
            'description' => 'This is an updated fun deal.',
        ]);
        return response()->json($deal);
    }

    // Delete a fun deal
    public function destroy($id)
    {
        $deal = FunDeals::findOrFail($id);
        $deal->delete();
        return response()->json(['message' => 'Fun deal deleted']);
    }
}
