<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarreraRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $carreraId = $this->route('carrera')->id ?? $this->route('carrera');

        return [
            'nombre' => ['required', 'string', 'max:100', 'unique:carrera,nombre,' . $carreraId],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'estado' => ['required', 'string', 'in:Activo,Inactivo'],
        ];
    }
}
