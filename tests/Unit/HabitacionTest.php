<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Habitacion;
use App\Models\Servicio;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HabitacionTest extends TestCase
{
    use RefreshDatabase;

    public function test_habitacion_can_have_servicios()
    {
        $habitacion = Habitacion::factory()->create();
        $servicio = Servicio::factory()->create();

        $habitacion->servicios()->attach($servicio->id);

        $this->assertTrue($habitacion->servicios->contains($servicio));
    }

    public function test_soft_delete_habitacion()
    {
        $habitacion = Habitacion::factory()->create();
        $habitacion->delete();

        $this->assertSoftDeleted('habitaciones', ['id' => $habitacion->id]);
    }
}
