@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow">

    <h1 class="text-3xl font-bold mb-6 text-gray-800">Nueva Reserva</h1>

    <form action="{{ route('reservas.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Habitación</label>
            <select name="habitacion_id"
                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500">
                @foreach($habitaciones as $h)
                    <option value="{{ $h->id }}">{{ $h->numero }} - {{ $h->tipo }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Cliente</label>
            <select name="cliente_id"
                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500">
                @foreach($clientes as $c)
                    <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Fecha Entrada</label>
            <input type="date" name="fecha_entrada"
                   class="w-full p-3 border rounded-lg focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Fecha Salida</label>
            <input type="date" name="fecha_salida"
                   class="w-full p-3 border rounded-lg focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Servicios Adicionales</label>
            <textarea name="servicios" rows="3"
                      class="w-full p-3 border rounded-lg focus:ring-blue-500"></textarea>
        </div>

        <div class="flex gap-3">
            <button class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">
                Guardar
            </button>

            <a href="{{ route('reservas.index') }}"
               class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg shadow">
                Cancelar
            </a>
        </div>

    </form>

</div>
@endsection
