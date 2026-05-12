<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Ноутбук Apple MacBook Air 13"',
            'description' => 'M1, 8GB RAM, 256GB SSD',
            'price' => 89900,
            'stock' => 10,
            'image' => 'https://picsum.photos/id/0/300/300'
        ]);

        Product::create([
            'name' => 'iPhone 15 Pro',
            'description' => '128GB, Черный титан',
            'price' => 99900,
            'stock' => 15,
            'image' => 'https://picsum.photos/id/1/300/300'
        ]);

        Product::create([
            'name' => 'Наушники Sony WH-1000XM5',
            'description' => 'Беспроводные, шумоподавление',
            'price' => 29900,
            'stock' => 20,
            'image' => 'https://picsum.photos/id/2/300/300'
        ]);
    }
}