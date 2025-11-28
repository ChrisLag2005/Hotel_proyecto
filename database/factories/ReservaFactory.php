<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Reservacion;

class ReservaFactory extends Factory
{
    protected $model = Reservacion::class;
    public function definition()
    {
        $fechaEntrada = $this->faker->dateTimeBetween('now', '+30 days');
        $fechaSalida = $this->faker->dateTimeBetween($fechaEntrada, '+45 days');
        
        return [
            'usuario_id' => \App\Models\Usuario::factory(),
            'habitacion_id' => \App\Models\Habitacion::factory(),
            'fecha_entrada' => $fechaEntrada,
            'fecha_salida' => $fechaSalida,
            'estado' => $this->faker->randomElement(['confirmada', 'pendiente', 'cancelada', 'completada']),
            'total' => $this->faker->randomFloat(2, 100, 2000),
            'numero_huespedes' => $this->faker->numberBetween(1, 4),
            'notas' => $this->faker->optional()->text(200),
        ];
    }
}