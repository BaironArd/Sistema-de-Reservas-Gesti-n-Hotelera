<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre', 'documento', 'telefono', 'email', 'historial'
    ];

    public function reservas() {
        return $this->hasMany(Reserva::class);
    }
}

