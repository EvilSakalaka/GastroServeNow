<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::create([
            'name' => 'Pizza Margherita',
            'category' => 'Étel',
            'price' => 1200.00,
            'status' => 'available',
            'photo_url' => 'https://example.com/photos/pizza_margherita.jpg',
            'is_featured' => true,
            'area_id' => 1, // kitchen
        ]);

        \App\Models\Product::create([
            'name' => 'Coca-Cola',
            'category' => 'Ital',
            'price' => 400.00,
            'status' => 'available',
            'photo_url' => 'https://example.com/photos/coca_cola.jpg',
            'is_featured' => false,
            'area_id' => 2, // bar
        ]);

        \App\Models\Product::create([
            'name' => 'Caesar Saláta',
            'category' => 'Étel',
            'price' => 900.00,
            'status' => 'unavailable',
            'photo_url' => 'https://example.com/photos/caesar_salad.jpg',
            'is_featured' => false,
            'area_id' => 1, // kitchen
        ]);
    }
}
