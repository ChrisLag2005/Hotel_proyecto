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

        
        foreach ($habitaciones as $habitacion) {
            $serviciosAleatorios = $servicios->random(rand(2, 4));
            
            foreach ($serviciosAleatorios as $servicio) {
                $habitacion->servicios()->attach($servicio->id, [
                    'precio_extra' => $servicio->precio_adicional,
                    'incluido' => $servicio->precio_adicional == 0, 
                ]);
            }
        }
    }
}