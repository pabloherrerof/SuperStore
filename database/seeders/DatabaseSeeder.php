<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
    /*      User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.admin',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);
          */

/*     User::factory(5)->create(); */
        $this->call([
/*             GroupsSeeder::class,
            CategorySeeder::class,
            ClientSeeder::class, */
            ProductSeeder::class,
        ]);
    }
}
