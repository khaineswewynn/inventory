<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('customers')->insert([
            ['name' => 'John Doe', 'email' => 'john@example.com', 'phone' => '5555555555', 'address' => '789 Pine St'],
            ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'phone' => '4444444444', 'address' => '321 Elm St'],
        ]);
    }
}
