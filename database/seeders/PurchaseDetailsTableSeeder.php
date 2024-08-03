<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('purchase_details')->insert([
            ['provider_id' => 1, 'product_id' => 1, 'purchase_id' => 1 , 'qty' => 50, 'price' => 1000.00, 'total_order' => 50000.00],
            ['provider_id' => 2, 'product_id' => 2, 'purchase_id' => 2 , 'qty' => 30, 'price' => 700.00, 'total_order' => 21000.00],
        ]);
    }
}
