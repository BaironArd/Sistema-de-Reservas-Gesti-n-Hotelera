<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $clientes = Cliente::when($search, function($query) use ($search) {
            $query->where('nombre', 'like', "%$search%")
                ->orWhere('documento', 'like', "%$search%");
        })->get();

        return view('clientes.index', compact('clientes', 'search'));
    }


    public function create()
    {
        return view('clientes.create');
    }

    public function store(StoreClienteRequest $request)
    {
        $request->validate([
            'nombre' => 'required',
            'documento' => 'required|unique:clientes',
            'telefono' => 'required',
            'email' => 'required|email',
            'historial' => 'nullable'
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required',
            'documento' => 'required|unique:clientes,documento,' . $cliente->id,
            'telefono' => 'required',
            'email' => 'required|email',
            'historial' => 'nullable'
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado');
    }
    
    public function pdf()
    {
        $clientes = Cliente::all();

        $pdf = Pdf::loadView('clientes.pdf', compact('clientes'));
        return $pdf->download('clientes.pdf');
    }

    
}
