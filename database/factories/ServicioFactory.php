<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServicioFactory extends Factory
{
    public function definition()
    {
        return [
            'nombre' => $this->faker->randomElement(['Wi-Fi', 'Desayuno', 'Piscina', 'Spa', 'Gimnasio', 'Estacionamiento']),
            'descripcion' => $this->faker->sentence(),
            'precio_adicional' => $this->faker->randomFloat(2, 0, 100),
            'disponible' => $this->faker->boolean(90), // 90% de probabilidad de estar disponible
        ];
    }
}