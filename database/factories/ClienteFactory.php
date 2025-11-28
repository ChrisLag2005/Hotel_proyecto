<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UsuarioFactory extends Factory
{
    public function definition()
    {
        return [
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'telefono' => $this->faker->phoneNumber(),
            'direccion' => $this->faker->address(),
            'tipo' => $this->faker->randomElement(['cliente', 'administrador', 'empleado']),
        ];
    }
}