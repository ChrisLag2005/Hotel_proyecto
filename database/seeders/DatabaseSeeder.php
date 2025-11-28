<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // COMENTAR TODO LO RELACIONADO CON USER/USUARIO
        // Ya que vamos a usar Cliente para el sistema de hotel
        
        // Solo ejecutar tus seeders personalizados
        $this->call([
            ClienteSeeder::class,     // Este creará los clientes
            HabitacionSeeder::class,  // Este creará las habitaciones
            ServicioSeeder::class,    // Este creará los servicios
            ReservacionSeeder::class, // Este creará las reservaciones
        ]);
    }
}