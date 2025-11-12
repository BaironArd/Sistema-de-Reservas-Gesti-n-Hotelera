@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow">

    <h1 class="text-3xl font-bold mb-6 text-gray-800">Nuevo Cliente</h1>

    <form action="{{ route('clientes.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Nombre</label>
            <input type="text" name="nombre"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                   required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Documento</label>
            <input type="text" name="documento"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                   required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Teléfono</label>
            <input type="text" name="telefono"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                   required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Email</label>
            <input type="email" name="email"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                   required>
        </div>

        <div class="flex gap-3">
            <button class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">
                Guardar
            </button>

            <a href="{{ route('clientes.index') }}"
               class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg shadow">
                Cancelar
            </a>
        </div>

    </form>

</div>
@endsection
