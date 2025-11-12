<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservaRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'habitacion_id' => 'required|exists:habitaciones,id',
            'cliente_id' => 'required|exists:clientes,id',
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'required|date|after:fecha_entrada',
            'servicios' => 'nullable'
        ];
    }
}
