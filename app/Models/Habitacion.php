<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;

     protected $table = 'habitaciones';

    protected $fillable = [
        'numero',
        'tipo',
        'descripcion',
        'precio',
        'capacidad',
        'estado',
    ];

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'habitacion_servicio')
                    ->withPivot('precio_extra', 'incluido')
                    ->withTimestamps();
    }


    public function reservaciones()
    {
        return $this->hasMany(Reservacion::class);
    }
}
