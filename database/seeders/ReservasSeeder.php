<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reserva;

class ReservasSeeder extends Seeder
{
    public function run(): void
    {
        Reserva::create([
            'habitacion_id' => 1,
            'cliente_id' => 1,
            'fecha_entrada' => '2025-01-10',
            'fecha_salida' => '2025-01-12',
            'servicios' => 'Desayuno incluido'
        ]);
    }
}
