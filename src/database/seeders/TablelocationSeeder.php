<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tables = [
            // Beltéri asztalok
            ['table_number' => 1, 'location_description' => 'Bejárat mellett - ablakkal szemben', 'status' => 'available', 'active' => true],
            ['table_number' => 2, 'location_description' => 'Bejárat mellett - jobb oldal', 'status' => 'available', 'active' => true],
            ['table_number' => 3, 'location_description' => 'Közép terasz - 4 személyes', 'status' => 'available', 'active' => true],
            ['table_number' => 4, 'location_description' => 'Közép terasz - 2 személyes', 'status' => 'reserved', 'active' => true],
            ['table_number' => 5, 'location_description' => 'Közép terasz - 6 személyes', 'status' => 'available', 'active' => true],
            ['table_number' => 6, 'location_description' => 'Jobb sarok - ablak mellett', 'status' => 'available', 'active' => true],
            ['table_number' => 7, 'location_description' => 'Jobb sarok - ablaknál', 'status' => 'available', 'active' => true],
            ['table_number' => 8, 'location_description' => 'Bal oldal - mosdó mellett', 'status' => 'reserved', 'active' => true],
            ['table_number' => 9, 'location_description' => 'Bal oldal - konyha közelében', 'status' => 'available', 'active' => true],
            ['table_number' => 10, 'location_description' => 'Hátsó szoba - privát terület', 'status' => 'available', 'active' => true],
            
            // Terasz asztalok
            ['table_number' => 11, 'location_description' => 'Terasz - bal sarok', 'status' => 'available', 'active' => true],
            ['table_number' => 12, 'location_description' => 'Terasz - közép', 'status' => 'available', 'active' => true],
            ['table_number' => 13, 'location_description' => 'Terasz - jobb sarok', 'status' => 'reserved', 'active' => true],
            ['table_number' => 14, 'location_description' => 'Terasz - 2 személyes - bal oldal', 'status' => 'available', 'active' => true],
            ['table_number' => 15, 'location_description' => 'Terasz - 2 személyes - jobb oldal', 'status' => 'available', 'active' => true],
            
            // VIP területek
            ['table_number' => 16, 'location_description' => 'VIP szoba - nagy asztal', 'status' => 'available', 'active' => true],
            ['table_number' => 17, 'location_description' => 'VIP szoba - 2 személyes', 'status' => 'available', 'active' => true],
            ['table_number' => 18, 'location_description' => 'Bar pult - jobb oldal', 'status' => 'available', 'active' => true],
            ['table_number' => 19, 'location_description' => 'Bar pult - bal oldal', 'status' => 'available', 'active' => true],
            ['table_number' => 20, 'location_description' => 'Sarok asztal - bejárat mellett', 'status' => 'reserved', 'active' => true],
        ];

        foreach ($tables as $table) {
            \App\Models\TableLocation::create($table);
        }
    }
}