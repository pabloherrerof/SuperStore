<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Is_Admin;
use App\Models\Category;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::whereHas('user', function($query) {
            $query->where('role', '!=', 'admin'); 
        })->with('user')->get();

        return Inertia::render('Client/Clients', [
            'clients' => $clients,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return Inertia::render(
            'Client/CreateClient',
            ['categories' => $categories]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'address' => 'required|string|max:255',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
            'image' => 'nullable|string',  
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'client';
        $user->save();


        $client = new Client();
        $client->image = $request->image;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->user_id = $user->id;
        $client->save();

        $client->categories()->attach($request->category_ids);

        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        $categories = Category::all();
        $user = $client->user;
        
        return Inertia::render(
            'Client/EditClient',
            [
                'client' => $client->load('categories')->load('categories'),
                'categories' => $categories
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
            'image' => 'nullable|string',  
        ]);

        $client->user->name = $request->name;
        $client->user->email = $request->email;
        $client->user->save();

        $client->image = $request->image;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->save();

        $client->categories()->sync($request->category_ids);

        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        $user = Client::where('user_id', $client->user_id)->first();

        $user->delete();


        return redirect()->route('clients.index');
    }
}



