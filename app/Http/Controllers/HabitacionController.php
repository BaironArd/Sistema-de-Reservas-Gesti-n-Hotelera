<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreHabitacionRequest;
use App\Http\Requests\UpdateHabitacionRequest;

use Illuminate\Http\Request;
use App\Models\Habitacion;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\QueryException;

class HabitacionController extends Controller
{
    
    public function index(Request $request)
    {
        $search = $request->input('search');
        $estado = $request->input('estado');

        $habitaciones = Habitacion::when($search, function($query) use ($search) {
                $query->where('numero', 'like', "%$search%")
                    ->orWhere('tipo', 'like', "%$search%");
            })
            ->when($estado, function($query) use ($estado) {
                $query->where('estado', $estado);
            })
            ->get();

        return view('habitaciones.index', compact('habitaciones', 'search', 'estado'));
    }


    public function create()
    {
        return view('habitaciones.create');
    }

    public function store(StoreHabitacionRequest $request)
    {
        $request->validate([
            'numero' => 'required|unique:habitaciones',
            'tipo' => 'required',
            'precio' => 'required|numeric',
            'estado' => 'required',
            'foto' => 'image|mimes:jpg,png,jpeg'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('habitaciones', 'public');
        }

        Habitacion::create($data);

        return redirect()->route('habitaciones.index')->with('success', 'Habitación creada');
    }

    public function edit(Habitacion $habitacion)
    {
        return view('habitaciones.edit', compact('habitacion'));
    }

    public function update(UpdateHabitacionRequest $request, Habitacion $habitacion)
    {
        $request->validate([
            'tipo' => 'required',
            'precio' => 'required|numeric',
            'estado' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('habitaciones', 'public');
        }

        $habitacion->update($data);

        return redirect()->route('habitaciones.index')->with('success', 'Habitación actualizada');
    }

    public function destroy(Habitacion $habitacion)
{
    // Si tiene reservas asociadas, no permitimos borrar
    if ($habitacion->reservas()->exists()) {
        return redirect()
            ->route('habitaciones.index')
            ->with('error', 'No se puede eliminar la habitación porque tiene reservas asociadas.');
    }

    try {
        // eliminar foto si quieres (opcional)
        if ($habitacion->foto) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($habitacion->foto);
        }

        $habitacion->delete();

        return redirect()->route('habitaciones.index')->with('success', 'Habitación eliminada correctamente.');
    } catch (QueryException $e) {
        // Capturamos cualquier error de BD y devolvemos mensaje amigable
        return redirect()
            ->route('habitaciones.index')
            ->with('error', 'Ocurrió un error al eliminar la habitación. Inténtalo de nuevo.');
    } catch (\Exception $e) {
        return redirect()
            ->route('habitaciones.index')
            ->with('error', 'Error inesperado al eliminar la habitación.');
    }
}

    public function pdf()
    {
        $habitaciones = Habitacion::all();

        $pdf = Pdf::loadView('habitaciones.pdf', compact('habitaciones'));
        return $pdf->download('habitaciones.pdf');
    }
}
