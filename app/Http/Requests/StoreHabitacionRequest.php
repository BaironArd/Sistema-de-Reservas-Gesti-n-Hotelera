<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHabitacionRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'numero' => 'required|unique:habitaciones',
            'tipo' => 'required',
            'precio' => 'required|numeric',
            'estado' => 'required',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg'
        ];
    }
}
