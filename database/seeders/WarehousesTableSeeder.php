<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('warehouses')->insert([
            ['name' => 'Main Warehouse', 'isRefrigerated' => 'No', 'location_id' => 1],
            ['name' => 'Backup Warehouse', 'isRefrigerated' => 'Yes', 'location_id' => 2],
        ]);
    }
}
