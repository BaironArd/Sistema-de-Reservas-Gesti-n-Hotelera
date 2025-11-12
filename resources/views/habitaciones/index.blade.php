@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4">

    <h2 class="text-3xl font-bold mb-6 text-gray-800">Habitaciones</h2>

    <div class="flex gap-3 mb-6">
        <a href="{{ route('habitaciones.create') }}"
           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow">
            Agregar Habitación
        </a>

        <a href="{{ route('habitaciones.pdf') }}"
           class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl shadow">
            Descargar PDF
        </a>
    </div>

<form method="GET" action="{{ route('habitaciones.index') }}" class="mb-4 flex gap-3">

    <input type="text" name="search" value="{{ $search }}"
           placeholder="Buscar número/tipo"
           class="p-3 border rounded-lg w-64">

    <select name="estado" class="p-3 border rounded-lg">
        <option value="">Estado (todos)</option>
        <option value="Disponible" {{ $estado=='Disponible'?'selected':'' }}>Disponible</option>
        <option value="Ocupada" {{ $estado=='Ocupada'?'selected':'' }}>Ocupada</option>
    </select>

    <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
        Filtrar
    </button>

</form>


    <div class="overflow-x-auto rounded-xl shadow">
        <table class="w-full border-collapse bg-white">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-3 text-left">Número</th>
                    <th class="p-3 text-left">Tipo</th>
                    <th class="p-3 text-left">Precio</th>
                    <th class="p-3 text-left">Estado</th>
                    <th class="p-3 text-left">Foto</th>
                    <th class="p-3 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($habitaciones as $habitacion)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-3">{{ $habitacion->numero }}</td>
                        <td class="p-3">{{ $habitacion->tipo }}</td>
                        <td class="p-3">${{ $habitacion->precio }}</td>
                        <td class="p-3">{{ $habitacion->estado }}</td>
                        <td class="p-3">
                            @if($habitacion->foto)
                                <img src="{{ asset('storage/'.$habitacion->foto) }}"
                                     class="w-20 h-16 object-cover rounded-md shadow">
                            @endif
                        </td>
                        <td class="p-3 flex gap-2">

                            <a href="{{ route('habitaciones.edit', $habitacion->id) }}"
                               class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow text-sm">
                                Editar
                            </a>

                            <form action="{{ route('habitaciones.destroy', $habitacion->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('¿Seguro que deseas eliminar esta habitación?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
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
