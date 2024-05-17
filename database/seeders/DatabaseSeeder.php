<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin12',
            'email' => 'admin12@gmail.com',
            'address' => 'binus alsut',
            'phone_number' => '0215813913',
            'password' => bcrypt("admin123"),
            'role' => "admin"
        ]);

        DB::table('users')->insert([
            'username' => 'admin123',
            'email' => 'admin123@gmail.com',
            'address' => 'binus alsut',
            'phone_number' => '0215813913',
            'password' => bcrypt("admin123"),
            'role' => "admin"
        ]);

        DB::table('users')->insert([
            'username' => 'nicho123',
            'email' => 'nicho123@gmail.com',
            'address' => 'binus alsut',
            'phone_number' => '0215813913',
            'password' => bcrypt("nicho123"),
            'role' => "member"
        ]);

        DB::table('users')->insert([
            'username' => 'jason123',
            'email' => 'jason123@gmail.com',
            'address' => 'binus alsut',
            'phone_number' => '0215813913',
            'password' => bcrypt("jason123"),
            'role' => "member"
        ]);
        \App\Models\User::factory(50)->create();
        \App\Models\Item::factory(50)->create();
        \App\Models\Cart::factory(50)->create();
    }
}
