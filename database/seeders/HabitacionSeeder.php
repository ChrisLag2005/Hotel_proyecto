<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Habitacion;

class HabitacionSeeder extends Seeder
{
public function run()
{
    // Crear 15 habitaciones de prueba
    Habitacion::factory()->count(15)->create();
    
    // Crear habitaciones específicas con números que no generará la factory
    Habitacion::factory()->create([
        'numero' => 1001, // Cambiar a número más alto
        'tipo' => 'suite',
        'precio' => 350.00,
        'estado' => 'disponible',
    ]);
    
    Habitacion::factory()->create([
        'numero' => 1002, // Cambiar a número más alto  
        'tipo' => 'doble',
        'precio' => 180.00,
        'estado' => 'disponible',
    ]);
}
}