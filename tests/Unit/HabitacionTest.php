<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Habitacion;
use App\Models\Servicio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class HabitacionTest extends TestCase
{
    use RefreshDatabase;

    public function test_habitacion_can_have_servicios()
    {
        $habitacion = Habitacion::factory()->create();
        $servicio = Servicio::factory()->create();
        $data['imagen'] = UploadedFile::fake()->image('habitacion.jpg');

        $habitacion->servicios()->attach($servicio->id);

        $this->assertTrue($habitacion->servicios->contains($servicio));
    }

   
}
