<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Habitacion;
use App\Models\Servicio;

class HabitacionServicioSeeder extends Seeder
{
    public function run()
    {
        $habitaciones = Habitacion::all();
        $servicios = Servicio::all();

        // Si no hay servicios, creamos algunos de ejemplo
        if ($servicios->isEmpty()) {
            $servicios = collect([
                Servicio::create(['nombre' => 'WiFi', 'precio_adicional' => 0]),
                Servicio::create(['nombre' => 'Desayuno', 'precio_adicional' => 100]),
                Servicio::create(['nombre' => 'Spa', 'precio_adicional' => 200]),
                Servicio::create(['nombre' => 'Estacionamiento', 'precio_adicional' => 50]),
                Servicio::create(['nombre' => 'Gimnasio', 'precio_adicional' => 0]),
            ]);
        }

        foreach ($habitaciones as $habitacion) {
            // Nos aseguramos de no pedir más servicios de los que hay disponibles
            $cantidad = rand(2, min(4, $servicios->count()));
            $serviciosAleatorios = $servicios->random($cantidad);

            foreach ($serviciosAleatorios as $servicio) {
                $habitacion->servicios()->attach($servicio->id, [
                    'precio_extra' => $servicio->precio_adicional,
                    'incluido' => $servicio->precio_adicional == 0,
                ]);
            }
        }
    }
}
