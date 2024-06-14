<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {



        $products = [
            // Mobile Devices
            ['name' => 'iPhone 14', 'description' => 'Latest Apple iPhone with advanced features', 'price' => 999.99, 'image' => null],
            ['name' => 'Samsung Galaxy S21', 'description' => 'High-end Samsung smartphone with powerful performance', 'price' => 799.99, 'image' => null],

            // Tablets
            ['name' => 'iPad Pro', 'description' => 'Apple iPad Pro with M1 chip and stunning display', 'price' => 1099.99, 'image' => null],
            ['name' => 'Samsung Galaxy Tab S7', 'description' => 'Samsung tablet with high-performance and S Pen support', 'price' => 649.99, 'image' => null],

            // Laptop
            ['name' => 'MacBook Pro', 'description' => 'Apple MacBook Pro with M1 chip and sleek design', 'price' => 1299.99, 'image' => null],
            ['name' => 'Dell XPS 13', 'description' => 'Dell XPS 13 with InfinityEdge display and powerful specs', 'price' => 999.99, 'image' => null],

            // Desktop
            ['name' => 'iMac', 'description' => 'Apple iMac with Retina display and M1 chip', 'price' => 1399.99, 'image' => null],
            ['name' => 'HP Pavilion', 'description' => 'HP Pavilion desktop with reliable performance', 'price' => 799.99, 'image' => null],

            // TVs
            ['name' => 'Samsung QLED 8K', 'description' => 'Samsung 8K TV with QLED technology', 'price' => 4999.99, 'image' => null],
            ['name' => 'LG OLED CX', 'description' => 'LG OLED TV with stunning picture quality', 'price' => 1799.99, 'image' => null],

            // Consoles
            ['name' => 'PlayStation 5', 'description' => 'Sony PlayStation 5 with next-gen gaming performance', 'price' => 499.99, 'image' => null],
            ['name' => 'Xbox Series X', 'description' => 'Microsoft Xbox Series X with powerful gaming capabilities', 'price' => 499.99, 'image' => null],

            // Headphones
            ['name' => 'Sony WH-1000XM4', 'description' => 'Sony noise-canceling headphones with superior sound quality', 'price' => 349.99, 'image' => null],
            ['name' => 'Bose QuietComfort 35 II', 'description' => 'Bose headphones with noise-canceling technology', 'price' => 299.99, 'image' => null],

            // Speakers
            ['name' => 'Sonos One', 'description' => 'Sonos One smart speaker with excellent sound', 'price' => 199.99, 'image' => null],
            ['name' => 'JBL Charge 4', 'description' => 'JBL portable speaker with powerful sound', 'price' => 149.99, 'image' => null],
        ];

        $productCategories = [[1], [1, 2], [3, 2], [3, 2], [4, 2], [4, 2], [5, 2], [5, 2], [6, 2], [6, 2], [7, 2], [7, 2], [8, 2], [8, 2]];

        foreach ($products as $index =>  $product) {
            \App\Models\Product::create($product);
        }
    }
}
