<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 


class Reservacion extends Model
{
         use HasFactory, SoftDeletes;

    protected $table = 'reservaciones';

    protected $fillable = [
        'user_id',
        'habitacion_id',
        'fecha_inicio',
        'fecha_fin',
        'adultos',
        'ninos',
        'estado',
        'total',
    ];

    // Relación con usuario (nuevo)
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}


    // Relación con habitación
    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class);
    }

    protected $dates = ['deleted_at'];
}
