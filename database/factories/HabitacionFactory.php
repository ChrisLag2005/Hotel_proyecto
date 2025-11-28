<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HabitacionFactory extends Factory
{
    public function definition()
    {
        return [
            'numero' => $this->faker->unique()->numberBetween(100, 999),
            'tipo' => $this->faker->randomElement(['individual', 'doble', 'suite', 'familiar']),
            'precio' => $this->faker->randomFloat(2, 50, 500),
            'estado' => $this->faker->randomElement(['disponible', 'ocupada', 'mantenimiento' ]),
            'capacidad' => $this->faker->numberBetween(1, 6),
            'descripcion' => $this->faker->sentence(10),
            
            'imagen' => $this->faker->optional()->imageUrl(),
        ];
    }
}