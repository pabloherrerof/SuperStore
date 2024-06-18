<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Client;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Group;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.admin',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);
          

          User::create([
            'name' => 'User',
            'email' => 'user@user.user',
            'password' => Hash::make('user'),
            'role' => 'client',
        ]);

        Client::create([
            'phone' => '123456789',
            'address' => '1234 Main St',
            'image' => 'https://via.placeholder.com/150',
            'user_id' => 2,
        ]);

    User::factory(5)->create(); 
        $this->call([
           GroupsSeeder::class,
            CategorySeeder::class,
            ClientSeeder::class, 
            ProductSeeder::class
        ]);
    }
}
