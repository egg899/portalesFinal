<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;


class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        Producto::create([
            'nombre' => 'ElectroPods',
            'descripcion' => 'Auriculares inalámbricos con cancelación de ruido, Bluetooth 5.3 y 30 horas de batería.',
            'precio' => 129.99,
            'imagen' => 'electropods.jpg',
        ]);

        Producto::create([
            'nombre' => 'AudioMix Pro 2',
            'descripcion' => 'Interfaz de audio USB-C con preamplificadores de calidad de estudio, ideal para grabaciones caseras.',
            'precio' => 249.99,
            'imagen' => 'audiomix_pro_2.jpg',
        ]);

         Producto::create([
            'nombre' => 'AmpBlaster Mini',
            'descripcion' => 'Amplificador portátil de 15W con batería recargable y conectividad Bluetooth.',
            'precio' => 159.50,
            'imagen' => 'ampblaster_mini.jpg',
        ]);




    }
}
