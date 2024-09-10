<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'KaNaung',
            'email' => 'kanaung@gmial.com',
            'password' => Hash::make('aaaaaa'), // Make sure to hash the password
            'role_id' => 1,
        ]);
    }
}
