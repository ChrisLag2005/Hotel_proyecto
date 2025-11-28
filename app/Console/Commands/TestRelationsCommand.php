<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Habitacion;
use App\Models\Servicio;

class TestRelationsCommand extends Command
{
    protected $signature = 'test:relations';
    protected $description = 'Probar relaciones entre habitaciones y servicios';

    public function handle()
    {
        $this->info('🧪 Probando relaciones Habitación-Servicios...');
        
        try {
            // Crear habitación
            $habitacion = Habitacion::create([
                'numero' => '999',
                'tipo' => 'Doble',
                'descripcion' => 'Habitación de prueba',
                'precio' => 150.00,
                'capacidad' => 2,
                'estado' => 'disponible'
            ]);
            $this->info('✅ Habitación creada: ' . $habitacion->numero);
            
            // Crear servicios
            $wifi = Servicio::create(['nombre' => 'WiFi', 'precio_adicional' => 0]);
            $tv = Servicio::create(['nombre' => 'TV Cable', 'precio_adicional' => 10]);
            $this->info('✅ Servicios creados');
            
            // Asignar relaciones
            $habitacion->servicios()->attach($wifi->id, ['incluido' => true]);
            $habitacion->servicios()->attach($tv->id, ['incluido' => false, 'precio_extra' => 5]);
            $this->info('✅ Relaciones establecidas');
            
            // Mostrar resultados
            $habitacionConServicios = Habitacion::with('servicios')->first();
            $this->info('Habitación: ' . $habitacionConServicios->numero);
            
            foreach ($habitacionConServicios->servicios as $servicio) {
                $this->line(" - {$servicio->nombre} (Incluido: " . ($servicio->pivot->incluido ? 'Sí' : 'No') . ")");
            }
            
            $this->info('🎉 ¡Prueba exitosa!');
            
        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
        }
    }
}