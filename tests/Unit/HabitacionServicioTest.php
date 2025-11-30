<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Habitacion;
use App\Models\Servicio;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HabitacionServicioTest extends TestCase
{
    use RefreshDatabase;

    public function test_habitacion_can_have_servicios()
    {
        $habitacion = Habitacion::factory()->create();
        $servicio = Servicio::factory()->create();

        $habitacion->servicios()->attach($servicio->id);

        $this->assertTrue($habitacion->servicios->contains($servicio));
    }

    public function test_servicio_can_be_attached_to_habitacion()
    {
        $servicio = Servicio::factory()->create();
        $habitacion = Habitacion::factory()->create();

        $habitacion->servicios()->attach($servicio->id);

        $this->assertTrue($habitacion->servicios->contains($servicio));
    }
}
