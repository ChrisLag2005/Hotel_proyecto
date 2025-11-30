<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_mostrar_formulario_de_registro()
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    /** @test */
    public function puede_registrarse_como_cliente()
    {
        $response = $this->post(route('register.post'), [
            'name' => 'Cliente Test',
            'email' => 'cliente@test.com',
            'password' => '1234',
            'password_confirmation' => '1234',
            'role' => 'cliente',
        ]);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('users', [
            'email' => 'cliente@test.com',
            'role' => 'cliente',
        ]);
    }

    /** @test */
    public function no_puede_registrarse_como_admin_sin_clave_correcta()
    {
        $response = $this->post(route('register.post'), [
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => '1234',
            'password_confirmation' => '1234',
            'role' => 'administrador',
            'clave_admin' => 'clave-incorrecta'
        ]);

        $response->assertSessionHasErrors('clave_admin');
        $this->assertDatabaseMissing('users', [
            'email' => 'admin@test.com'
        ]);
    }

    /** @test */
    public function puede_login_usuario_existente()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password123')
        ]);

        $response = $this->post(route('login.post'), [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('welcome.hotel'));
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function puede_logout_usuario()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('logout'));

        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }
}
