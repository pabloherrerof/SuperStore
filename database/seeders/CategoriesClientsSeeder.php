<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::all();
        $categories = Category::all();

        foreach ($clients as $client) {
            $client->categories()->attach($categories->random(rand(1, 3))->pluck('id'));
        }
    }
}
