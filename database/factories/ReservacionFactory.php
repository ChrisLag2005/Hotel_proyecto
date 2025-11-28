<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Reservacion;
use App\Models\User;
use App\Models\Habitacion;

class ReservacionFactory extends Factory
{
    protected $model = Reservacion::class;

    public function definition()
    {
        $fechaInicio = $this->faker->dateTimeBetween('now', '+30 days');
        $fechaFin = $this->faker->dateTimeBetween($fechaInicio, '+45 days');
        
        return [
            'cliente_id' => \App\Models\Cliente::factory(),
            'habitacion_id' => Habitacion::factory(),
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'adultos' => $this->faker->numberBetween(1, 4),
            'ninos' => $this->faker->numberBetween(0, 2),
            'estado' => $this->faker->randomElement(['pendiente', 'confirmada', 'cancelada', 'finalizada']),
            'total' => $this->faker->randomFloat(2, 100, 2000),
        ];
    }
}