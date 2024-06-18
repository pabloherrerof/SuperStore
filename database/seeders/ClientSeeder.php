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
          'phone' => '987654321',
          'address' => '4321 Main St',
          'image' => 'https://via.placeholder.com/150',
          'user_id' => $user[2]['id'],
        ],
        [
          'phone' => '123123123',
          'address' => '123 Main St',
          'image' => 'https://via.placeholder.com/150',
          'user_id' => $user[4]['id'],
        ],
        [
          'phone' => '321321321',
          'address' => '321 Main St',
          'image' => 'https://via.placeholder.com/150',
          'user_id' => $user[5]['id'],
        ],
        [
          'phone' => '456456456',
          'address' => '456 Main St',
          'image' => 'https://via.placeholder.com/150',
          'user_id' => $user[6]['id'],
        ],
      ];

      foreach ($clients as $client) {
        Client::create($client);
      }

    }
}
