<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Habitacion;

class HabitacionesSeeder extends Seeder
{
    public function run(): void
    {
        Habitacion::create([
            'numero' => '101',
            'tipo' => 'Sencilla',
            'precio' => 120000,
            'estado' => 'Disponible',
            'foto' => null
        ]);

        Habitacion::create([
            'numero' => '202',
            'tipo' => 'Doble',
            'precio' => 180000,
            'estado' => 'Disponible',
            'foto' => null
        ]);
    }
}
