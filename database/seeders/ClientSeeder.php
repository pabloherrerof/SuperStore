<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Client;
use App\Models\Groups;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $user = User::all()->toArray();

      $clients = [
        [
          'phone' => '123456789',
          'address' => '1234 Main St',
          'image' => 'https://via.placeholder.com/150',
          'user_id' => $user[0]['id'],
        ],
        [
          'phone' => '987654321',
          'address' => '4321 Main St',
          'image' => 'https://via.placeholder.com/150',
          'user_id' => $user[1]['id'],
        ],
        [
          'phone' => '123123123',
          'address' => '123 Main St',
          'image' => 'https://via.placeholder.com/150',
          'user_id' => $user[2]['id'],
        ],
        [
          'phone' => '321321321',
          'address' => '321 Main St',
          'image' => 'https://via.placeholder.com/150',
          'user_id' => $user[3]['id'],
        ],
        [
          'phone' => '456456456',
          'address' => '456 Main St',
          'image' => 'https://via.placeholder.com/150',
          'user_id' => $user[4]['id'],
        ],
      ];

      foreach ($clients as $client) {
        Client::create($client);
      }

    }
}
