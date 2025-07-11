<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('usuarios')->insert([
    [
        'id' => 1,
        'username' => 'admin@electropoint.com',
        'password' => Hash::make('12345678'),
        'role' => 'admin',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'id' => 2,
        'username' => 'user@electropoint.com',
        'password' => Hash::make('12345678'),
        'role' => 'user',
        'created_at' => now(),
        'updated_at' => now(),
    ]
]);
    }
}
