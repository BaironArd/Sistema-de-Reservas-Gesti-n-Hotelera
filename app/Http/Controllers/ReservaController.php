<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreReservaRequest;
use App\Http\Requests\UpdateReservaRequest;

use App\Models\Reserva;
use App\Models\Habitacion;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class ReservaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $fecha = $request->fecha;

        $reservas = Reserva::with('habitacion', 'cliente')
            ->when($search, function($query) use ($search) {
                $query->whereHas('cliente', function($q) use ($search){
                    $q->where('nombre', 'like', "%$search%");
                })->orWhereHas('habitacion', function($q) use ($search){
                    $q->where('numero', 'like', "%$search%");
                });
            })
            ->when($fecha, function($query) use ($fecha){
                $query->where('fecha_entrada', '<=', $fecha)
                    ->where('fecha_salida', '>=', $fecha);
            })
            ->get();

        return view('reservas.index', compact('reservas', 'search', 'fecha'));
    }


    public function create()
    {
        $habitaciones = Habitacion::all();
        $clientes = Cliente::all();

        return view('reservas.create', compact('habitaciones', 'clientes'));
    }

    public function store(StoreReservaRequest $request)
{
    // datos validados por FormRequest
    $data = $request->validated();

    // comprobar solapamiento: existe al menos una reserva para la misma habitación
    // cuyo rango se solape con el nuevo (entrada <= nueva_salida) && (salida >= nueva_entrada)
    $existeSolapamiento = Reserva::where('habitacion_id', $data['habitacion_id'])
        ->where(function($q) use ($data) {
            $q->where(function($q2) use ($data) {
                $q2->where('fecha_entrada', '<=', $data['fecha_salida'])
                   ->where('fecha_salida', '>=', $data['fecha_entrada']);
            });
        })
        ->exists();

    if ($existeSolapamiento) {
        return back()->withInput()->with('error', 'La habitación ya tiene una reserva en ese rango de fechas.');
    }

    $reserva = Reserva::create($data);

    // NO setear permanente 'Ocupada' aquí si quieres permitir reservas futuras.
    // Solo marcar habitación como Ocupada si la reserva incluye la fecha actual (hoy)
    $hoy = date('Y-m-d');
    if ($reserva->fecha_entrada <= $hoy && $reserva->fecha_salida >= $hoy) {
        $reserva->habitacion()->update(['estado' => 'Ocupada']);
    }

    return redirect()->route('reservas.index')->with('success', 'Reserva creada correctamente');
}


    public function edit(Reserva $reserva)
    {
        $habitaciones = Habitacion::all();
        $clientes = Cliente::all();

        return view('reservas.edit', compact('reserva', 'habitaciones', 'clientes'));
    }

    public function update(UpdateReservaRequest $request, Reserva $reserva)
{
    $data = $request->validated();

    // verificar solapamiento omitiendo la propia reserva
    $existeSolapamiento = Reserva::where('habitacion_id', $data['habitacion_id'])
        ->where('id', '!=', $reserva->id)
        ->where(function($q) use ($data) {
            $q->where(function($q2) use ($data) {
                $q2->where('fecha_entrada', '<=', $data['fecha_salida'])
                   ->where('fecha_salida', '>=', $data['fecha_entrada']);
            });
        })
        ->exists();

    if ($existeSolapamiento) {
        return back()->withInput()->with('error', 'La habitación ya tiene una reserva en ese rango de fechas.');
    }

    $reserva->update($data);

    return redirect()->route('reservas.index')->with('success', 'Reserva actualizada');
}


    public function destroy(Reserva $reserva)
    {
        // Guardar id habitación ANTES de borrar la reserva
        $habitacionId = $reserva->habitacion_id;

        // Liberar habitación
        Habitacion::where('id', $habitacionId)->update(['estado' => 'Disponible']);
+
        // Borrar reserva
        $reserva->delete();

        return redirect()->route('reservas.index')
            ->with('success', 'Reserva eliminada correctamente.');
    }


    public function pdf()
    {
        $reservas = Reserva::with(['habitacion', 'cliente'])->get();
        $pdf = Pdf::loadView('reservas.pdf', compact('reservas'));
        return $pdf->download('reservas.pdf');
    }
    public function calendar()
{
    // vista que contiene el calendario
    return view('reservas.calendar');
}

    public function events()
    {
        // devuelve las reservas como eventos para FullCalendar
        $reservas = Reserva::with('habitacion','cliente')->get();

        $events = $reservas->map(function($r){
            return [
                'id' => $r->id,
                'title' => $r->habitacion->numero . ' - ' . $r->cliente->nombre,
                'start' => $r->fecha_entrada,
                // FullCalendar espera end como fecha no inclusiva; sumamos 1 día para mostrar la noche final correctamente
                'end' => date('Y-m-d', strtotime($r->fecha_salida . ' +1 day')),
                'extendedProps' => [
                    'servicios' => $r->servicios
                ]
            ];
        });

        return response()->json($events);
    }
    public function api(Request $request)
{
    $habitacionFiltro = $request->habitacion; // número o vacío
    $estadoFiltro = $request->estado ? strtolower($request->estado) : ''; // normalizamos a minúsculas

    $habitaciones = Habitacion::when($habitacionFiltro, function($q) use ($habitacionFiltro){
        $q->where('numero', $habitacionFiltro);
    })->get();

    $eventos = [];
    $hoy = date('Y-m-d');
    $dias = 30; // días a generar

    foreach ($habitaciones as $habitacion) {
        for ($i = 0; $i < $dias; $i++) {
            $fecha = date('Y-m-d', strtotime("$hoy +$i days"));

            $reserva = Reserva::where('habitacion_id', $habitacion->id)
                ->where('fecha_entrada', '<=', $fecha)
                ->where('fecha_salida', '>=', $fecha)
                ->with('cliente')
                ->first();

            if ($reserva) {
                // Evento ocupado (asociado a una reserva real)
                $evento = [
                    'id' => $reserva->id,
                    'title' => "Hab. {$habitacion->numero} — Ocupada ({$reserva->cliente->nombre})",
                    'start' => $fecha,
                    'color' => '#dc2626',
                    'backgroundColor' => '#dc2626',
                    'borderColor' => '#b91c1c',
                    'textColor' => '#ffffff',
                    'extendedProps' => [
                        'tipo' => 'ocupada',
                        'habitacion_num' => $habitacion->numero,
                        'reserva_id' => $reserva->id,
                        'checked_in_at' => $reserva->checked_in_at,
                        'checked_out_at' => $reserva->checked_out_at,
                    ],
                ];
            } else {
                // Evento disponible
                $evento = [
                    'id' => 'disp-'.$habitacion->id.'-'.$fecha,
                    'title' => "Hab. {$habitacion->numero} — Disponible",
                    'start' => $fecha,
                    'color' => '#16a34a',
                    'backgroundColor' => '#16a34a',
                    'borderColor' => '#15803d',
                    'textColor' => '#ffffff',
                    'extendedProps' => [
                        'tipo' => 'disponible',
                        'habitacion_num' => $habitacion->numero,
                    ],
                ];
            }

            // aplicar filtro por estado (comparación ya en minusculas)
            if ($estadoFiltro) {
                if ($estadoFiltro === 'disponible' && $evento['extendedProps']['tipo'] !== 'disponible') {
                    continue;
                }
                if ($estadoFiltro === 'ocupada' && $evento['extendedProps']['tipo'] !== 'ocupada') {
                    continue;
                }
            }

            $eventos[] = $evento;
        }
    }

    return response()->json($eventos);
}



    
    public function checkin(Reserva $reserva)
{
    // registrar hora de entrada
    $reserva->update(['checked_in_at' => now()]);

    // marcar habitación como ocupada (estado actual del hotel)
    Habitacion::where('id', $reserva->habitacion_id)->update(['estado' => 'Ocupada']);

    // redirigir a índice de reservas para recargar la tabla con los cambios
    return redirect()->route('reservas.index')->with('success', 'Entrada registrada correctamente.');
}

public function checkout(Reserva $reserva)
{
    // registrar hora de salida (auditoría)
    $reserva->update(['checked_out_at' => now()]);

    // liberar habitación
    Habitacion::where('id', $reserva->habitacion_id)->update(['estado' => 'Disponible']);

    // eliminar la reserva (según tu lógica)
    $reserva->delete();

    return redirect()->route('reservas.index')
        ->with('success', 'Salida registrada y reserva eliminada correctamente.');
}




}
