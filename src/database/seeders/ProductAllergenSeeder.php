<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductAllergenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('product_allergens')->insert([
            ['product_id' => 1, 'allergen_id' => 1], // Glutén
            ['product_id' => 1, 'allergen_id' => 7], // Tej
        ]);

        
        DB::table('product_allergens')->insert([
            ['product_id' => 2, 'allergen_id' => 12], // Kén-dioxid és szulfitok
        ]);

        
        DB::table('product_allergens')->insert([
            ['product_id' => 3, 'allergen_id' => 1], // Glutén
            ['product_id' => 3, 'allergen_id' => 3], // Tojás
            ['product_id' => 3, 'allergen_id' => 7], // Tej
        ]);


        DB::table('product_allergens')->insert([
            ['product_id' => 5, 'allergen_id' => 1], // Glutén
            ['product_id' => 5, 'allergen_id' => 7], // Tej
        ]);


        DB::table('product_allergens')->insert([
            ['product_id' => 6, 'allergen_id' => 1], // Glutén
            ['product_id' => 6, 'allergen_id' => 3], // Tojás
        ]);


        DB::table('product_allergens')->insert([
            ['product_id' => 7, 'allergen_id' => 1], // Glutén
            ['product_id' => 7, 'allergen_id' => 3], // Tojás
            ['product_id' => 7, 'allergen_id' => 7], // Tej
            ['product_id' => 7, 'allergen_id' => 8], // Diófélék
        ]);


        DB::table('product_allergens')->insert([
            ['product_id' => 8, 'allergen_id' => 3], // Tojás
            ['product_id' => 8, 'allergen_id' => 7], // Tej
        ]);


        DB::table('product_allergens')->insert([
            ['product_id' => 9, 'allergen_id' => 1], // Glutén
            ['product_id' => 9, 'allergen_id' => 7], // Tej
        ]);


        DB::table('product_allergens')->insert([
            ['product_id' => 10, 'allergen_id' => 4], // Hal
            ['product_id' => 10, 'allergen_id' => 7], // Tej
        ]);

        DB::table('product_allergens')->insert([
            ['product_id' => 12, 'allergen_id' => 7], // Tej
        ]);


        DB::table('product_allergens')->insert([
            ['product_id' => 14, 'allergen_id' => 1], // Glutén
        ]);


        DB::table('product_allergens')->insert([
            ['product_id' => 15, 'allergen_id' => 12], // Kén-dioxid és szulfitok
        ]);
    }
}