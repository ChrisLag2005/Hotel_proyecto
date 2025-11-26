<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{

     protected $table = 'habitaciones';

    protected $fillable = [
        'numero',
        'tipo',
        'descripcion',
        'precio',
        'capacidad',
        'estado',
    ];

    public function reservaciones()
    {
        return $this->hasMany(Reservacion::class);
    }
}
