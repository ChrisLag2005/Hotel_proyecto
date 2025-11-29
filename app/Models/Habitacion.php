<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;

     protected $table = 'habitaciones';

    
    protected $fillable = [
    'numero', 'tipo', 'capacidad', 'precio', 
    'estado', 'imagen', 'imagen_original'
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
