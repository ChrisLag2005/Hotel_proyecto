<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    use HasFactory;

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
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con habitación
    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class);
    }
}
