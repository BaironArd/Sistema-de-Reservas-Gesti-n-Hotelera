@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4">

    <h1 class="text-3xl font-bold mb-6 text-gray-800">Clientes</h1>

    <div class="flex gap-3 mb-6">
        <a href="{{ route('clientes.create') }}"
           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow">
            + Nuevo Cliente
        </a>

        <a href="{{ route('clientes.pdf') }}"
           class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl shadow">
            Descargar PDF
        </a>
    </div>
    <form action="{{ route('clientes.index') }}" method="GET" class="mb-4 flex gap-3">
    <input type="text" name="search" value="{{ $search }}"
           placeholder="Buscar cliente..."
           class="p-3 border rounded-lg w-64">

    <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
        Buscar
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
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Nombre</th>
                    <th class="p-3 text-left">Documento</th>
                    <th class="p-3 text-left">Teléfono</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($clientes as $cliente)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-3">{{ $cliente->id }}</td>
                        <td class="p-3">{{ $cliente->nombre }}</td>
                        <td class="p-3">{{ $cliente->documento }}</td>
                        <td class="p-3">{{ $cliente->telefono }}</td>
                        <td class="p-3">{{ $cliente->email }}</td>

                        <td class="p-3 flex gap-2">
                            <a href="{{ route('clientes.edit', $cliente) }}"
                               class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow text-sm">
                                Editar
                            </a>

                            <form action="{{ route('clientes.destroy', $cliente) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('¿Eliminar cliente?')"
                                        class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow text-sm">
                                    Eliminar
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
