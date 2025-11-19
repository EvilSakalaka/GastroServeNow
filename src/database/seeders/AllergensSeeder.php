<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllergensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allergens = [
            ['name' => 'Glutén'],
            ['name' => 'Krémsajt'],
            ['name' => 'Tojás'],
            ['name' => 'Hal'],
            ['name' => 'Földimogyoró'],
            ['name' => 'Szója'],
            ['name' => 'Tej'],
            ['name' => 'Diófélék'],
            ['name' => 'Zeller'],
            ['name' => 'Mustár'],
            ['name' => 'Szezámmag'],
            ['name' => 'Kén-dioxid és szulfitok'],
            ['name' => 'Csillagfürt'],
            ['name' => 'Puhatestűek'],
        ];

        foreach ($allergens as $allergen) {
            \App\Models\Allergen::create($allergen);
        }
    }
}
