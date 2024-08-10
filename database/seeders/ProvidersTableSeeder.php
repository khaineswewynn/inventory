<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('providers')->insert([
            ['name' => 'Provider 1', 'address' => '123 Main St', 'phone' => '1234567890'],
            ['name' => 'Provider 2', 'address' => '456 Oak St', 'phone' => '0987654321'],
        ]);
    }
}
