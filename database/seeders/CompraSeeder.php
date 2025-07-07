<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Compra;
use App\Models\Usuario;
use App\Models\Producto;

class CompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('compras')->insert([
                [
                'usuario_id' => 1,
                'producto_id' => 1,
                'cantidad' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'usuario_id' => 2,
                'producto_id' => 1,
                'cantidad' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                ],
            ]);
    }
}
