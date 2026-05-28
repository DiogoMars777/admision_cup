<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMateriaRequest extends FormRequest
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
        $materiaId = $this->route('materia')->id ?? $this->route('materia');

        return [
            'nombre' => ['required', 'string', 'max:100', 'unique:materia,nombre,' . $materiaId],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'estado' => ['required', 'string', 'in:Activo,Inactivo'],
        ];
    }
}
