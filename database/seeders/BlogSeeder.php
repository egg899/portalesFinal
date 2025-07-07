<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::create([
            'titulo' => '¡Lanzamos nuestra nueva app!',
            'rating_fk' => 2,
            'contenido' => 'Hoy presentamos una actualización',
            'autor' => 'Equipo de Desarrollo',
            'imagen' => 'nueva-app.jpg',
        ]);

        Blog::create([
            'titulo' => 'Consejos para aprovechar el producto',
             'rating_fk' => 3,
            'contenido' => 'Estos consejos te ayudaran a sacarle el máximo provecho...',
            'autor' => 'Soporte Técnico',
            'imagen' => 'soporte-tecnico.jpg',

        ]);


        DB::table('blogs_have_categorias')->insert([
            ['blogs_fk' => 1, 'categoria_fk' => 1 ],
            ['blogs_fk' => 1, 'categoria_fk' => 7 ],
            ['blogs_fk' => 1, 'categoria_fk' => 14],
            ['blogs_fk' => 2, 'categoria_fk' => 3],
            ['blogs_fk' => 2, 'categoria_fk' => 5],
            ['blogs_fk' => 2, 'categoria_fk' => 9],
        ]);
    }
}
