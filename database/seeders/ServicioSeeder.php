<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    public function run()
    {
        $servicios = [
            ['nombre' => 'Wi-Fi', 'descripcion' => 'Internet inalámbrico gratuito', 'precio_adicional' => 0],
            ['nombre' => 'Desayuno', 'descripcion' => 'Desayuno buffet incluido', 'precio_adicional' => 25.00],
            ['nombre' => 'Piscina', 'descripcion' => 'Acceso a piscina climatizada', 'precio_adicional' => 0],
            ['nombre' => 'Spa', 'descripcion' => 'Acceso a área de spa', 'precio_adicional' => 50.00],
            ['nombre' => 'Estacionamiento', 'descripcion' => 'Estacionamiento cubierto', 'precio_adicional' => 15.00],
            ['nombre' => 'Gimnasio', 'descripcion' => 'Acceso a gimnasio 24/7', 'precio_adicional' => 0],
        ];

        foreach ($servicios as $servicio) {
            Servicio::factory()->create($servicio);
        }
    }
}