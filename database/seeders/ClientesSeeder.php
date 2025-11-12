<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClientesSeeder extends Seeder
{
    public function run(): void
    {
        Cliente::create([
            'nombre' => 'Juan Pérez',
            'documento' => '123456789',
            'telefono' => '3001234567',
            'email' => 'juan@example.com',
            'historial' => 'Cliente frecuente'
        ]);

        Cliente::create([
            'nombre' => 'María Gómez',
            'documento' => '987654321',
            'telefono' => '3019876543',
            'email' => 'maria@example.com',
            'historial' => 'Prefiere habitaciones premium'
        ]);
    }
}
