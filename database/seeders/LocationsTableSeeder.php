<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('locations')->insert([
            ['name' => 'Warehouse 1', 'address' => '123 Warehouse Ave'],
            ['name' => 'Warehouse 2', 'address' => '456 Storage Blvd'],
        ]);
    }
}
