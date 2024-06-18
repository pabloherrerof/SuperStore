<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Group;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
    
        if ($user->role == 'admin') {
            $groups = Group::with('categories')->get();
        } else {
            $client = Client::with('categories')->where('user_id', $user->id)->first();
            $categoryIds = $client->categories->pluck('id');
    
            $groups = Group::with(['categories' => function ($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds);
            }])->get()->filter(function ($group) {
                return $group->categories->isNotEmpty();
            });
        }
    
        // Ensure the result is always an array
        $groupsArray = $groups->values()->toArray();
    
        return Inertia::render('Categories/Categories', [
            'groups' => $groupsArray,
        ]);
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
    public function show(Group $groups)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $groups)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $groups)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $groups)
    {
        //
    }
}
