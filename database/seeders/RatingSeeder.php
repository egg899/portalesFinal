<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ratings')->insert([
            [
                'rating_id' => 1,
                'name' => 'Bueno',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'rating_id' => 2,
                'name' => 'Muy Bueno',
                'created_at' => now(),
                'updated_at' => now(),
            ],


            [
                'rating_id' => 3,
                'name' => 'Excelente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
