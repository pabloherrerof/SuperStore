<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role == 'admin') {
            $products = Product::all();
            return response()->json($products);
        } else {
            $client = Client::with('categories')->where('user_id', $user->id)->first();

            if (!$client) {
                return response()->json(['error' => 'Client not found'], 404);
            }

            $categoryIds = $client->categories->pluck('id');

            $products = Product::whereHas('category', function ($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds);
            })->get();

            return response()->json($products);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $user = auth()->user();

        if ($user->role == 'admin') {
            return $product;
        } else {
            $client = Client::with('categories')->where('user_id', $user->id)->first();
            $product = Product::with('category')->where('id', $product->id)->first();

            foreach ($client->categories as $category) {
                foreach ($product->category as $productCategory) {
                    if ($category->id == $productCategory->id) {
                        return $product;
                    }
                }
            }

            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
