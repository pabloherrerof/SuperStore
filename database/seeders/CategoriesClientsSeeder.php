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
        $clientIds = Client::pluck('id')->toArray();
        $categoryIds = Category::pluck('id')->toArray();

        if(empty($clientIds) && empty($categoryIds)) {
            echo "No clients or categories found";
        } else {
            foreach ($clientIds as $client) {
                DB::table('categories_clients')->insert([
                    'client_id' => $client,
                    'category_id' => $categoryIds[array_rand($categoryIds)],
                ]); 
            }   
                  
        }
    }
}
