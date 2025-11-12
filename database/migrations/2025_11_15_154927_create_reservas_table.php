<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('habitacion_id');
    $table->unsignedBigInteger('cliente_id');
    $table->date('fecha_entrada');
    $table->date('fecha_salida');
    $table->string('servicios')->nullable();
    $table->timestamps();

    $table->foreign('habitacion_id')->references('id')->on('habitaciones');
    $table->foreign('cliente_id')->references('id')->on('clientes');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
