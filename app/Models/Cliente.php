<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
     use HasFactory;
    public function reservaciones()
{
    return $this->hasMany(Reservacion::class, 'cliente_id');
}
}
