<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Habitacion;
use App\Models\User;   
use App\Models\Reservacion;
use Illuminate\Database\Seeder;

class ReservacionSeeder extends Seeder
{
    public function run()
    {
        // Crear 20 reservaciones de prueba
        Reservacion::factory()->count(20)->create();
        
        // Opcional: crear reservaciones específicas
        $user = User::first();
        $habitacion = Habitacion::where('estado', 'disponible')->first();
        
        if ($user && $habitacion) {
            Reservacion::factory()->create([
                'user_id' => $user->id,
                'habitacion_id' => $habitacion->id,
                'fecha_inicio' => now()->addDays(5),
'fecha_fin' => now()->addDays(10),
                'estado' => 'confirmada',
                'total' => 900.00,
            ]);
        }
    }
}