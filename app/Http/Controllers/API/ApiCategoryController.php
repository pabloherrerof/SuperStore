<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use Illuminate\Http\Request;

class ApiCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth = auth()->user();

        $client = Client::where('user_id', $auth->id)->first();

        if ($auth->role == 'admin') {
            $categories = Category::all();
            return response()->json($categories);
        } else {
            $categories = Category::whereHas('clients', function ($query) use ($auth) {
                $client = Client::where('user_id', $auth->id)->first();
                $query->where('client_id', $client->id);
            })->get();

            return response()->json($categories);
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
    public function show(Category $category)
    {
        $auth = auth()->user();

        
        if ($auth->role == 'admin') {
            return $category;
        } else {
            $client = Client::with('categories')->where('user_id', $auth->id)->first();
            if($client->categories->contains($category->id)){
                $category = Category::with('products')->find($category->id);
                return $category;
            }else{
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        }

      
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
