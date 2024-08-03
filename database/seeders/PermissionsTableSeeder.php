<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('permissions')->insert([
            ['role_id' => 1, 'route_name' => 'create-sales'],
            ['role_id' => 1, 'route_name' => 'edit-sales'],
            ['role_id' => 1, 'route_name' => 'delete-sales'],
            ['role_id' => 1, 'route_name' => 'view-sales'],
            ['role_id' => 1, 'route_name' => 'create-purchase'],
            ['role_id' => 1, 'route_name' => 'edit-purchase'],
            ['role_id' => 1, 'route_name' => 'delete-purchase'],
            ['role_id' => 1, 'route_name' => 'view-purchase'],
            ['role_id' => 1, 'route_name' => 'create-stockprice'],
            ['role_id' => 1, 'route_name' => 'edit-stockprice'],
            ['role_id' => 1, 'route_name' => 'view-stockprice'],
            ['role_id' => 1, 'route_name' => 'delete-stockprice'],

            ['role_id' => 2, 'route_name' => 'create-sales'],
            ['role_id' => 2, 'route_name' => 'edit-sales'],
            ['role_id' => 2, 'route_name' => 'delete-sales'],
            ['role_id' => 2, 'route_name' => 'view-sales'],
            ['role_id' => 2, 'route_name' => 'create-purchase'],
            ['role_id' => 2, 'route_name' => 'edit-purchase'],
            ['role_id' => 2, 'route_name' => 'delete-purchase'],
            ['role_id' => 2, 'route_name' => 'view-purchase'],
            ['role_id' => 2, 'route_name' => 'create-stockprice'],
            ['role_id' => 2, 'route_name' => 'edit-stockprice'],
            ['role_id' => 2, 'route_name' => 'view-stockprice'],
            ['role_id' => 2, 'route_name' => 'delete-stockprice'],

            ['role_id' => 3, 'route_name' => 'create-sales'],
            ['role_id' => 4, 'route_name' => 'create-purchase']
            
        ]);
    }
}
