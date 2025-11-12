@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow">

    <h2 class="text-3xl font-bold mb-6 text-gray-800">Crear Habitación</h2>

    <form action="{{ route('habitaciones.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Número</label>
            <input type="text" name="numero"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                   required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Tipo</label>
            <input type="text" name="tipo"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                   required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Precio</label>
            <input type="number" name="precio"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                   required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Estado</label>
            <select name="estado"
                    class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="Disponible">Disponible</option>
                <option value="Ocupada">Ocupada</option>
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Foto</label>
            <input type="file" name="foto"
                   class="w-full p-3 border rounded-lg bg-gray-50 cursor-pointer">
        </div>

        <button class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl text-lg shadow">
            Guardar
        </button>

    </form>

</div>
@endsection
