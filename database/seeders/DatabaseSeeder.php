<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            'name' => 'roshan',
            'email' => 'shan@gmail.com',
            'password' => Hash::make('password123'),
        ]);

        DB::table('users')->insert([
            'name' => 'Joko',
            'email' => 'joko12@gmail.com',
            'password' => Hash::make('password123'),
        ]);

        DB::table('users')->insert([
            'name' => 'rafi',
            'email' => 'rando12@gmail.com',
            'password' => Hash::make('password123'),
        ]);

        DB::table('stores')->insert([
            'name' => 'TOKO JAYA',
            'city' => 'SURABAYA',
            'user_id' => '1',
        ]);

        DB::table('stores')->insert([
            'name' => 'TOKO MAJU TERUS',
            'city' => 'BANDUNG',
            'user_id' => '2',
        ]);

        DB::table('stores')->insert([
            'name' => 'TOKO ABADI',
            'city' => 'BATU',
            'user_id' => '3',
        ]);




    }
}
