<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Cliente;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UserFactory extends Factory
{
    protected $model = Cliente::class;
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
    'nombre' => fake()->firstName(),
    'apellido' => fake()->lastName(),
    'email' => fake()->unique()->safeEmail(),
    'password' => static::$password ??= Hash::make('password'),
    'telefono' => fake()->phoneNumber(),
    'direccion' => fake()->address(),
    'tipo' => 'cliente',
];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
