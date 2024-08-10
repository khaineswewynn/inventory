<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('purchase_orders')->insert([
            ['order_no' => 'PO001',  'purchaseorder_date' => '2024-01-01'],
            ['order_no' => 'PO002',  'purchaseorder_date' => '2024-02-01'],
        ]);
    }
}
