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
        'archivo'
    ];

    public function reservaciones()
    {
        return $this->hasMany(Reservacion::class);
    }

    public function servicios()
{
    return $this->belongsToMany(\App\Models\Servicio::class, 'habitacion_servicio');
}

}
