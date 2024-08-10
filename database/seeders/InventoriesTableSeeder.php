<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('inventories')->insert([
            ['product_id' => 1, 'in_stock' => 50, 'out_stock' => 10, 'total' => 40, 'remaining' => 40],
            ['product_id' => 2, 'in_stock' => 30, 'out_stock' => 5, 'total' => 25, 'remaining' => 25],
        ]);
    }
}
