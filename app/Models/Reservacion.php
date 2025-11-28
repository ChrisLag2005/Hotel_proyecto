<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    use HasFactory;
      protected $table = 'reservaciones';

    protected $fillable = [
        'cliente_id',
        'habitacion_id',
        'fecha_inicio',
        'fecha_fin',
        'adultos',
        'ninos',
        'estado',
        'total',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class);
    }
}
