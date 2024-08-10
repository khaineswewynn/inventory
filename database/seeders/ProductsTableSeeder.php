<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            ['code' => 'P001', 'name' => 'Laptop', 'description' => 'High performance laptop', 'category_id' => 1, 'reorder_qty' => 10, 'refrigerated' => 0],
            ['code' => 'P002', 'name' => 'Smartphone', 'description' => 'Latest model smartphone', 'category_id' => 1, 'reorder_qty' => 20, 'refrigerated' => 0],
        ]);
    }
}
