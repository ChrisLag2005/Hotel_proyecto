<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    public function habitaciones()
    {
        return $this->belongsToMany(Habitacion::class, 'habitacion_servicio')
                    ->withPivot('precio_extra', 'incluido')
                    ->withTimestamps();
    }
}
