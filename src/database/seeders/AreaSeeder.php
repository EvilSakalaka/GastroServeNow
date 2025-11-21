<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Area::create([
            'name' => 'kitchen',
            'display_name' => 'Konyha',
            'active' => true,
        ]);

        \App\Models\Area::create([
            'name' => 'bar',
            'display_name' => 'Bár',
            'active' => true,
        ]);

        \App\Models\Area::create([
            'name' => 'all',
            'display_name' => 'Minden',
            'active' => true,
        ]);
    }
}
