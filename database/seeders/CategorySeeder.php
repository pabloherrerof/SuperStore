<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Groups;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Smartphones' => ['group' => 'Mobile Devices', 'color' => '#4CAF50'],
            'USB-C' => ['group' => 'Features', 'color' => '#FF5722'],
            'Tablets' => ['group' => 'Mobile Devices', 'color' => '#2196F3'],
            'Laptop' => ['group' => 'Computers', 'color' => '#FF9800'],
            'Desktop Computer' => ['group' => 'Computers', 'color' => '#9C27B0'],
            'TVs' => ['group' => 'Entertainment', 'color' => '#E91E63'],
            'Consoles' => ['group' => 'Entertainment', 'color' => '#00BCD4'],
            'Headphones' => ['group' => 'Audio', 'color' => '#8BC34A'],
            'Speakers' => ['group' => 'Audio', 'color' => '#FFEB3B'],
        ];

        foreach ($categories as $category => $details) {
            $group = Groups::where('name', $details['group'])->first();
            Category::create([
                'name' => $category,
                'color' => $details['color'],
                'group_id' => $group->id,
            ]);
        }
    }
}
