<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    public function run()
    {
        // Crear 10 clientes de prueba
        Cliente::factory()->count(10)->create();
        
        // Opcional: crear un cliente específico
        Cliente::factory()->create([
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'email' => 'juan@ejemplo.com',
            'tipo' => 'cliente',
        ]);
    }
}