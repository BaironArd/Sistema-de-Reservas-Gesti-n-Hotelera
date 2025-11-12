@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow">

    <h1 class="text-3xl font-bold mb-6 text-gray-800">Editar Reserva</h1>

    <form action="{{ route('reservas.update', $reserva) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Habitación</label>
            <select name="habitacion_id"
                    class="w-full p-3 border rounded-lg focus:ring-blue-500">
                @foreach($habitaciones as $h)
                    <option value="{{ $h->id }}" {{ $h->id == $reserva->habitacion_id ? 'selected' : '' }}>
                        {{ $h->numero }} - {{ $h->tipo }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Cliente</label>
            <select name="cliente_id"
                    class="w-full p-3 border rounded-lg focus:ring-blue-500">
                @foreach($clientes as $c)
                    <option value="{{ $c->id }}" {{ $c->id == $reserva->cliente_id ? 'selected' : '' }}>
                        {{ $c->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Fecha Entrada</label>
            <input type="date" name="fecha_entrada" value="{{ $reserva->fecha_entrada }}"
                   class="w-full p-3 border rounded-lg focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Fecha Salida</label>
            <input type="date" name="fecha_salida" value="{{ $reserva->fecha_salida }}"
                   class="w-full p-3 border rounded-lg focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Servicios</label>
            <textarea name="servicios" rows="3"
                      class="w-full p-3 border rounded-lg focus:ring-blue-500">{{ $reserva->servicios }}</textarea>
        </div>

        <button class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
            Actualizar
        </button>

    </form>

</div>
@endsection
