<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Habitacion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;


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

    // Sobrescribir 'imagen' con un archivo fake
    $data['imagen'] = \Illuminate\Http\UploadedFile::fake()->image('habitacion.jpg');

    $response = $this->post(route('habitaciones.store'), $data);

    $response->assertRedirect(route('habitaciones.index'));
    $this->assertDatabaseHas('habitaciones', ['numero' => $data['numero']]);
}

}