<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAulaRequest extends FormRequest
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
        $aulaId = $this->route('aula')->id ?? $this->route('aula');

        return [
            'aula_nro' => ['required', 'string', 'max:20', 'unique:aula,aula_nro,' . $aulaId],
            'capacidad' => ['required', 'integer', 'min:1'],
            'tipo_aula' => ['nullable', 'string', 'max:50'],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'aula_nro.unique' => 'El número de aula ya existe. Debe ser único para evitar colisiones físicas.',
            'capacidad.min' => 'La capacidad del aula debe ser un número entero positivo mayor a cero.',
        ];
    }
}
