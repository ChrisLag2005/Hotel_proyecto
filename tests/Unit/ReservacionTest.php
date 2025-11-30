<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Reservacion;
use App\Models\Habitacion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservacionTest extends TestCase
{
    use RefreshDatabase;

    public function test_reservacion_belongs_to_user_and_habitacion()
    {
        $user = User::factory()->create();
        $habitacion = Habitacion::factory()->create();

        $reservacion = Reservacion::factory()->create([
            'user_id' => $user->id,
            'habitacion_id' => $habitacion->id
        ]);

        $this->assertEquals($user->id, $reservacion->user->id);
        $this->assertEquals($habitacion->id, $reservacion->habitacion->id);
    }

    public function test_soft_delete_reservacion()
    {
        $reservacion = Reservacion::factory()->create();
        $reservacion->delete();

        $this->assertSoftDeleted('reservacions', ['id' => $reservacion->id]);
    }
}
