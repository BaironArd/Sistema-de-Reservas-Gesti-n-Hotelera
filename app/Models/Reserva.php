<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model {
    protected $fillable = [
        'habitacion_id',
        'cliente_id',
        'fecha_entrada',
        'fecha_salida',
        'servicios',
        'checked_in_at',    // <-- agregar
        'checked_out_at'    // <-- agregar
    ];

    // casteos útiles para trabajar con fechas fácilmente
    protected $casts = [
        'fecha_entrada' => 'date',
        'fecha_salida' => 'date',
        'checked_in_at' => 'datetime',
        'checked_out_at' => 'datetime',
    ];

    public function habitacion() { return $this->belongsTo(Habitacion::class); }
    public function cliente() { return $this->belongsTo(Cliente::class); }
}
