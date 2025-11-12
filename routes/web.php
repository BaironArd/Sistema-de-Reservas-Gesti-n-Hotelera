<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\ClienteController;

use App\Http\Controllers\ReservaController;

Route::get('/api/reservas', [ReservaController::class, 'api']);
Route::get('calendar', [ReservaController::class, 'calendar'])->name('calendar');

Route::get('habitaciones/pdf', [HabitacionController::class, 'pdf'])->name('habitaciones.pdf');
Route::get('clientes/pdf', [ClienteController::class, 'pdf'])->name('clientes.pdf');
Route::get('reservas/pdf', [ReservaController::class, 'pdf'])->name('reservas.pdf');

Route::resource('habitaciones', HabitacionController::class)
     ->parameters(['habitaciones' => 'habitacion']);
Route::resource('clientes', ClienteController::class);
Route::resource('reservas', ReservaController::class);

Route::put('reservas/{reserva}/checkin', [ReservaController::class, 'checkin'])->name('reservas.checkin');
Route::put('reservas/{reserva}/checkout', [ReservaController::class, 'checkout'])->name('reservas.checkout');

Route::get('/', function () {
    return view('dashboard');
    
});
