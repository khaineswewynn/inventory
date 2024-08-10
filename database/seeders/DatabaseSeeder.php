<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            UsersTableSeeder::class,
            ProvidersTableSeeder::class,
            CategoriesTableSeeder::class,
            CustomersTableSeeder::class,
            LocationsTableSeeder::class,
            ProductsTableSeeder::class,
            PurchaseOrdersTableSeeder::class,
            PurchaseDetailsTableSeeder::class,
            WarehousesTableSeeder::class,
            InventoriesTableSeeder::class,
            SalesTableSeeder::class,
            SalesDetailsTableSeeder::class,
            StockPriceTableSeeder::class,
            
        ]);

    }
}
