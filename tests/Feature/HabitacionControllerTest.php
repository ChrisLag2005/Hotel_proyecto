<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Habitacion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HabitacionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_view()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('habitaciones.index'));
        $response->assertStatus(200);
        $response->assertViewIs('habitaciones.index');
    }

    public function test_store_creates_habitacion()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = Habitacion::factory()->make()->toArray();
        $response = $this->post(route('habitaciones.store'), $data);

        $response->assertRedirect(route('habitaciones.index'));
        $this->assertDatabaseHas('habitaciones', ['numero' => $data['numero']]);
    }

    public function test_destroy_soft_deletes_habitacion()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $habitacion = Habitacion::factory()->create();
        $response = $this->delete(route('habitaciones.destroy', $habitacion));

        $response->assertRedirect(route('habitaciones.index'));
        $this->assertSoftDeleted('habitaciones', ['id' => $habitacion->id]);
    }
}
