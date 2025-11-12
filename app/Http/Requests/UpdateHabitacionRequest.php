<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHabitacionRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'tipo' => 'required',
            'precio' => 'required|numeric',
            'estado' => 'required',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg'
        ];
    }
}
