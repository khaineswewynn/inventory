<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            ['id' => 1, 'roles' => 'Admin'],
            ['id' => 2, 'roles' => 'Manager'],
            ['id' => 3, 'roles' => 'Sales_Staff'],
            ['id' => 4, 'roles' => 'Purchase_Staff'],
        ]);
    }
}
