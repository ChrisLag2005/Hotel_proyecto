<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = ['nombre','icono','descripcion'];

    public function habitaciones()
    {
        return $this->belongsToMany(Habitacion::class, 'habitacion_servicio');
    }
}
