<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockPriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('stock_price')->insert([
            ['product_id' => 1, 'buy_price' => 1000.00, 'sell_price' => 1200.00, 'qty' => 50, 'Percent' => 20],
            ['product_id' => 2, 'buy_price' => 700.00, 'sell_price' => 800.00, 'qty' => 30, 'Percent' => 14.29],
        ]);
    }
}
