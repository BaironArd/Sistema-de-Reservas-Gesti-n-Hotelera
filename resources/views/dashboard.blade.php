@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4">

    <h1 class="text-3xl font-bold text-gray-800 mb-8">
        Dashboard del Sistema
    </h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Habitaciones -->
        <div class="bg-white shadow rounded-xl p-6 border border-gray-200 text-center hover:shadow-lg transition">
            <h2 class="text-xl font-semibold text-gray-700">Habitaciones</h2>

            <a href="{{ route('habitaciones.index') }}"
               class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Ver módulo
            </a>
        </div>

        <!-- Clientes -->
        <div class="bg-white shadow rounded-xl p-6 border border-gray-200 text-center hover:shadow-lg transition">
            <h2 class="text-xl font-semibold text-gray-700">Clientes</h2>

            <a href="{{ route('clientes.index') }}"
               class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Ver módulo
            </a>
        </div>

        <!-- Reservas -->
        <div class="bg-white shadow rounded-xl p-6 border border-gray-200 text-center hover:shadow-lg transition">
            <h2 class="text-xl font-semibold text-gray-700">Reservas</h2>

            <a href="{{ route('reservas.index') }}"
               class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Ver módulo
            </a>
        </div>

    </div>

</div>
@endsection
