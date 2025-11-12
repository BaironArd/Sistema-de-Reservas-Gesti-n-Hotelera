@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow">

    <h2 class="text-3xl font-bold mb-6 text-gray-800">Editar Habitación</h2>

    <form action="{{ route('habitaciones.update', $habitacion->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Número</label>
            <input type="text" value="{{ $habitacion->numero }}"
                   class="w-full p-3 border rounded-lg bg-gray-100 cursor-not-allowed"
                   disabled>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Tipo</label>
            <input type="text" name="tipo" value="{{ $habitacion->tipo }}"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Precio</label>
            <input type="number" name="precio" value="{{ $habitacion->precio }}"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Estado</label>
            <select name="estado"
                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option {{ $habitacion->estado=='Disponible'?'selected':'' }}>Disponible</option>
                <option {{ $habitacion->estado=='Ocupada'?'selected':'' }}>Ocupada</option>
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Nueva foto (opcional)</label>
            <input type="file" name="foto"
                   class="w-full p-3 border rounded-lg bg-gray-50 cursor-pointer">
        </div>

        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl text-lg shadow">
            Actualizar
        </button>

    </form>

</div>
@endsection
