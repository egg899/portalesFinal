<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->insert([
    ['categoria_id' => 1, 'name' => 'Noticias',                     'created_at' => now(), 'updated_at' => now()],
    ['categoria_id' => 2, 'name' => 'Innovación',                   'created_at' => now(), 'updated_at' => now()],
    ['categoria_id' => 3, 'name' => 'Tutoriales',                   'created_at' => now(), 'updated_at' => now()],
    ['categoria_id' => 4, 'name' => 'Proyectos',                    'created_at' => now(), 'updated_at' => now()],
    ['categoria_id' => 5, 'name' => 'Recomendaciones',              'created_at' => now(), 'updated_at' => now()],
    ['categoria_id' => 6, 'name' => 'Reviews',                      'created_at' => now(), 'updated_at' => now()],
    ['categoria_id' => 7, 'name' => 'Lanzamientos',                 'created_at' => now(), 'updated_at' => now()],
    ['categoria_id' => 8, 'name' => 'Educación',                    'created_at' => now(), 'updated_at' => now()],
    ['categoria_id' => 9, 'name' => 'Tendencias',                   'created_at' => now(), 'updated_at' => now()],
    ['categoria_id' => 10, 'name' => 'Tips y trucos',               'created_at' => now(), 'updated_at' => now()],
    ['categoria_id' => 11, 'name' => 'Análisis',                    'created_at' => now(), 'updated_at' => now()],
    ['categoria_id' => 12, 'name' => 'Comparativas',                'created_at' => now(), 'updated_at' => now()],
    ['categoria_id' => 13, 'name' => 'Eventos',                     'created_at' => now(), 'updated_at' => now()],
    ['categoria_id' => 14, 'name' => 'Aplicaciones',                'created_at' => now(), 'updated_at' => now()],
    ['categoria_id' => 15, 'name' => 'Gadgets',                     'created_at' => now(), 'updated_at' => now()],
    ['categoria_id' => 16, 'name' => 'Hardware',                    'created_at' => now(), 'updated_at' => now()],
    ['categoria_id' => 17, 'name' => 'Software',                    'created_at' => now(), 'updated_at' => now()],
    ['categoria_id' => 18, 'name' => 'Robótica',                    'created_at' => now(), 'updated_at' => now()],
    ['categoria_id' => 19, 'name' => 'Inteligencia Artificial',     'created_at' => now(), 'updated_at' => now()],
    ['categoria_id' => 20, 'name' => 'Emprendimiento tecnológico',  'created_at' => now(), 'updated_at' => now()],
]);

    }
}
