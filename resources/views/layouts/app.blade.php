<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Sistema de Reservas</title>

    {{-- Cargar Tailwind + JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="bg-gray-100">

<nav class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">

        <a href="/" class="text-xl font-semibold">
            Sistema de Reservas
        </a>

        <ul class="flex gap-6">

            <li>
                <a href="{{ route('habitaciones.index') }}" 
                   class="hover:text-blue-400 transition">
                    Habitaciones
                </a>
            </li>

            <li>
                <a href="{{ route('clientes.index') }}" 
                   class="hover:text-blue-400 transition">
                    Clientes
                </a>
            </li>

            <li>
                <a href="{{ route('reservas.index') }}" 
                   class="hover:text-blue-400 transition">
                    Reservas
                </a>
            </li>

            <li>
                <a href="{{ route('calendar') }}" 
                   class="hover:text-blue-400 transition">
                    Calendario
                </a>
            </li>

        </ul>

    </div>
</nav>

<div class="max-w-7xl mx-auto p-6">
    @yield('content')
</div>

@stack('scripts')

</body>
</html>
