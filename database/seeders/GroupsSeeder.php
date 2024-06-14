<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            'Mobile Devices',
            'Computers',
            'Entertainment',
            'Audio',
            'Features',
        ];

        foreach ($groups as $group) {
            \App\Models\Groups::create([
                'name' => $group,
            ]);
        }
    }
}
