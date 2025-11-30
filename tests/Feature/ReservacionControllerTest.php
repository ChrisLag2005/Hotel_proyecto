<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Habitacion;
use App\Models\Reservacion;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservacionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_view()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('reservaciones.index'));
        $response->assertStatus(200);
        $response->assertViewIs('reservaciones.index');
    }

    public function test_store_creates_reservacion()
    {
        $user = User::factory()->create();
        $habitacion = Habitacion::factory()->create(['capacidad' => 4]);
        $this->actingAs($user);

        $data = [
            'habitacion_id' => $habitacion->id,
            'fecha_inicio' => now()->addDay()->format('Y-m-d'),
            'fecha_fin' => now()->addDays(2)->format('Y-m-d'),
            'adultos' => 2,
            'ninos' => 1,
        ];

        $response = $this->post(route('reservaciones.store'), $data);

        $response->assertRedirect(route('reservaciones.index'));
        $this->assertDatabaseHas('reservaciones', [
            'habitacion_id' => $habitacion->id,
            'user_id' => $user->id
        ]);
    }

    public function test_destroy_deletes_reservacion()
    {
        $user = User::factory()->create();
        $habitacion = Habitacion::factory()->create();
        $reservacion = Reservacion::factory()->create([
            'user_id' => $user->id,
            'habitacion_id' => $habitacion->id
        ]);

        $this->actingAs($user);
        $response = $this->delete(route('reservaciones.destroy', $reservacion));

        $response->assertRedirect(route('reservaciones.index'));
        $this->assertSoftDeleted('reservaciones', ['id' => $reservacion->id]);
    }
}
