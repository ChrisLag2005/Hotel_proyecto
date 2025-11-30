<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Habitacion;
use App\Models\Servicio;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HabitacionServicioControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_view()
    {
        $user = User::factory()->create(['role' => 'administrador']);
        $this->actingAs($user);

        $response = $this->get(route('habitaciones-servicios.index'));

        $response->assertStatus(200);
        $response->assertViewIs('habitaciones-servicios.index');
    }

    public function test_edit_returns_view()
    {
        $user = User::factory()->create(['role' => 'administrador']);
        $habitacion = Habitacion::factory()->create();
        Servicio::factory()->count(3)->create();

        $this->actingAs($user);

        $response = $this->get(route('habitaciones.servicios.edit', $habitacion));

        $response->assertStatus(200);
        $response->assertViewIs('habitaciones-servicios.edit');
        $response->assertViewHas(['habitacion', 'servicios', 'serviciosHabitacion']);
    }

    public function test_update_syncs_servicios()
    {
        $user = User::factory()->create(['role' => 'administrador']);
        $habitacion = Habitacion::factory()->create();
        $servicios = Servicio::factory()->count(2)->create();

        $this->actingAs($user);

        $data = [
            'servicios' => $servicios->pluck('id')->toArray(),
        ];

        $response = $this->post(route('habitaciones.servicios.update', $habitacion), $data);

        $response->assertRedirect(route('habitaciones-servicios.index'));
        $this->assertEquals(2, $habitacion->servicios()->count());
    }
}
