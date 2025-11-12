@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4">

    <h1 class="text-3xl font-bold mb-6 text-gray-800">Reservas</h1>

    <div class="flex gap-3 mb-6">
        <a href="{{ route('reservas.create') }}"
           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow">
            + Nueva Reserva
        </a>

        <a href="{{ route('reservas.pdf') }}"
           class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl shadow">
            Descargar PDF
        </a>
    </div>

    <form method="GET" action="{{ route('reservas.index') }}" class="mb-4 flex gap-3">

    <input type="text" name="search" value="{{ $search }}"
           placeholder="Buscar cliente o habitación"
           class="p-3 border rounded-lg w-64">

    <input type="date" name="fecha" value="{{ $fecha }}"
           class="p-3 border rounded-lg">

    <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
        Filtrar
    </button>

</form>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-xl shadow">
        <table class="w-full bg-white border-collapse">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-3 text-left">ID</</th>
                    <th class="p-3 text-left">Habitación</th>
                    <th class="p-3 text-left">Cliente</th>
                    <th class="p-3 text-left">Entrada</th>
                    <th class="p-3 text-left">Salida</th>
                    <th class="p-3 text-left">Servicios</th>
                    <th class="p-3 text-left">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($reservas as $reserva)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-3">{{ $reserva->id }}</td>
                        <td class="p-3">{{ $reserva->habitacion->numero }}</td>
                        <td class="p-3">{{ $reserva->cliente->nombre }}</td>
                        <td class="p-3">{{ $reserva->fecha_entrada }}</td>
                        <td class="p-3">{{ $reserva->fecha_salida }}</td>
                        <td class="p-3">{{ $reserva->servicios }}</td>

                        <td class="p-3 flex gap-2 items-center">
{{-- EDITAR --}}
    <a href="{{ route('reservas.edit', $reserva) }}"
       class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-sm text-center">
        Editar
    </a>

    {{-- ELIMINAR --}}
    <form action="{{ route('reservas.destroy', $reserva) }}" method="POST" class="m-0">
        @csrf
        @method('DELETE')

        <button onclick="return confirm('¿Eliminar reserva?')"
                class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow text-sm w-full">
            Eliminar
        </button>
    </form>
@php
    $hoy = \Carbon\Carbon::now()->startOfDay();
    $entrada = \Carbon\Carbon::parse($reserva->fecha_entrada)->startOfDay();
    $salida = \Carbon\Carbon::parse($reserva->fecha_salida)->endOfDay();
@endphp

{{-- CHECK-IN: solo si la reserva NO tiene checked_in y HOY está en el rango de la reserva --}}
@if(is_null($reserva->checked_in_at) && $hoy->between($entrada, $salida))
    <form method="POST" action="{{ route('reservas.checkin', $reserva) }}" class="m-0">
        @csrf
        @method('PUT')
        <button class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm">
            Registrar entrada
        </button>
    </form>
@endif

{{-- CHECK-OUT: solo si ya hay checked_in y NO hay checked_out --}}
@if(!is_null($reserva->checked_in_at) && is_null($reserva->checked_out_at))
    <form method="POST" action="{{ route('reservas.checkout', $reserva) }}" class="m-0">
        @csrf
        @method('PUT')
        <button class="px-3 py-1 bg-purple-600 hover:bg-purple-700 text-white rounded-lg text-sm">
            Registrar salida
        </button>
    </form>
@endif



</td>



                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
