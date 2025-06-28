<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    // List all products
    public function index()
    {
        $products = Products::all();
        return response()->json($products);
    }

    // Show a single product
    public function show($id)
    {
        $product = Products::findOrFail($id);
        return response()->json($product);
    }

    // Store a new product (demo data)
    public function store(Request $request)
    {
        $product = Products::create([
            'name' => 'Demo Product',
            'price' => 19.99,
        ]);
        return response()->json($product);
    }

    // Update a product (demo data)
    public function update(Request $request, $id)
    {
        $product = Products::findOrFail($id);
        $product->update([
            'name' => 'Updated Product',
            'price' => 29.99,
        ]);
        return response()->json($product);
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }
}
