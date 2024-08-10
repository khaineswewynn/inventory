<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('sales_details')->insert([
            ['product_id' => 1, 'sales_id' => 1 , 'price' => 1200.00, 'qty' => 1, 'total' => 1200.00],
            ['product_id' => 2, 'sales_id' => 2 , 'price' => 800.00, 'qty' => 2, 'total' => 1600.00],
        ]);
    }
}
