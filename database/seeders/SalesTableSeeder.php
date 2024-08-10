<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('sales')->insert([
            ['date' => '2024-03-01', 'number' => 'INV001',  'cus_id' => 1, 'email' => 'john@example.com', 'phone' => '5555555555'],
            ['date' => '2024-03-02', 'number' => 'INV002',  'cus_id' => 2, 'email' => 'jane@example.com', 'phone' => '4444444444'],
        ]);
    }
}
