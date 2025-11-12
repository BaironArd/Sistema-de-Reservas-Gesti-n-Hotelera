@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">

    <h1 class="text-3xl font-bold mb-6 text-gray-800">
        Calendario de Disponibilidad
    </h1>

<div class="mb-4">
    <label class="font-semibold">Filtrar por habitación:</label>
    <select id="filtroHabitacion" class="border p-2 rounded">
        <option value="">Todas</option>
        @foreach(\App\Models\Habitacion::all() as $h)
            <option value="{{ $h->numero }}">{{ $h->numero }} - {{ $h->tipo }}</option>
        @endforeach
    </select>
</div>
<select id="filtroEstado" class="border p-2 rounded">
    <option value="">Todos</option>
    <option value="Disponible">Disponibles</option>
    <option value="Ocupada">Ocupadas</option>
</select>


    <!-- Calendario -->
    <div id="calendar"
         class="bg-white rounded-xl shadow p-4 border border-gray-200"></div>

</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">

<style>
    .fc-toolbar-title {
        font-size: 1.4rem !important;
        font-weight: 700 !important;
        color: #1f2937;
    }

    .fc-button {
        padding: 6px 12px !important;
        background-color: #1e40af !important;
        border: none !important;
        border-radius: 6px !important;
        color: white !important;
    }

    .fc-button:hover {
        background-color: #1e3a8a !important;
    }

    /* Quitar borde feo por defecto */
    .fc thead th {
        background: #f3f4f6 !important;
        padding: 10px !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const calendarEl = document.getElementById('calendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',

        height: "auto",

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

        events: function(fetchInfo, successCallback, failureCallback) {
            let habitacionFiltro = document.getElementById('filtroHabitacion').value;
            let estadoFiltro = document.getElementById('filtroEstado') ? document.getElementById('filtroEstado').value : '';

            // normalizamos el estado para enviar siempre algo entendible
            // (backend ya hace lowercase pero no está de más)
            if (estadoFiltro) {
                estadoFiltro = estadoFiltro.toString();
            }

            fetch(`/api/reservas?habitacion=${habitacionFiltro}&estado=${estadoFiltro}`)
                .then(res => res.json())
                .then(data => {

                    const eventosFormateados = data.map(evt => {
                        // Si el backend envió backgroundColor / borderColor / textColor, usarlos.
                        // Si no, FullCalendar usará 'color' por defecto.
                        return {
                            ...evt,
                            backgroundColor: evt.backgroundColor || evt.color || undefined,
                            borderColor: evt.borderColor || evt.color || undefined,
                            textColor: evt.textColor || '#000000',
                            display: 'block'
                        };
                    });

                    successCallback(eventosFormateados);
                })
                .catch(err => {
                    console.error('Error cargando eventos:', err);
                    failureCallback(err);
                });
        },


        eventDidMount: function(info) {
            const tooltip = document.createElement('div');
            tooltip.innerHTML = `
                <div class="bg-gray-900 text-white text-xs px-3 py-1 rounded shadow">
                    ${info.event.title}
                </div>
            `;
            tooltip.style.position = "absolute";
            tooltip.style.zIndex = "9999";
            tooltip.style.display = "none";

            document.body.appendChild(tooltip);

            info.el.addEventListener("mouseenter", e => {
                tooltip.style.left = e.pageX + "px";
                tooltip.style.top = (e.pageY - 40) + "px";
                tooltip.style.display = "block";
            });
            info.el.addEventListener("mouseleave", () => {
                tooltip.style.display = "none";
            });
        },

        eventClick: function(info) {
    const tipo = info.event.extendedProps.tipo;
    if (tipo === 'ocupada') {
        if (confirm('Ver reserva?')) {
            window.location.href = `/reservas/${info.event.id}/edit`;
        }
    } else {
        // evento de disponibilidad: mostrar modal o nada
        alert(info.event.title);
    }
}

    });

    // 🔥🔥🔥 AQUI VAN LOS FILTROS (ANTES DEL RENDER)

    document.getElementById('filtroEstado')
        .addEventListener('change', () => calendar.refetchEvents());

    document.getElementById('filtroHabitacion')
        .addEventListener('change', () => calendar.refetchEvents());

    // ---- FIN DE LOS FILTROS ----

    calendar.render();
});

</script>
@endpush
