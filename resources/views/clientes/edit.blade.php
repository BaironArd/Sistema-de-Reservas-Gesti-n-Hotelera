@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow">

    <h1 class="text-3xl font-bold mb-6 text-gray-800">Editar Cliente</h1>

    <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Nombre</label>
            <input type="text" name="nombre" value="{{ $cliente->nombre }}"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Documento</label>
            <input type="text" name="documento" value="{{ $cliente->documento }}"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Teléfono</label>
            <input type="text" name="telefono" value="{{ $cliente->telefono }}"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Email</label>
            <input type="email" name="email" value="{{ $cliente->email }}"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div class="flex gap-3">
            <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                Actualizar
            </button>

            <a href="{{ route('clientes.index') }}"
               class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg shadow">
                Cancelar
            </a>
        </div>

    </form>

</div>
@endsection
