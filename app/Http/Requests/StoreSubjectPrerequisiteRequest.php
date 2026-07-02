<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectPrerequisiteRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
{
    return [
        'prerequisite_subject_id' => [
            'required',
            'exists:subjects,id',
        ],
    ];
}

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
{
    return [
        'prerequisite_subject_id.required' =>
            'Debe seleccionar un prerrequisito.',

        'prerequisite_subject_id.exists' =>
            'La materia prerrequisito no existe.',
    ];
}
}