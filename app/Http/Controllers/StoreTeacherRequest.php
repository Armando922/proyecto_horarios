<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prefijo_academico' => 'required|string|max:255',
            'nombre_completo' => 'required|string|max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            'prefijo_academico' => 'prefijo académico',
            'nombre_completo' => 'nombre completo',
        ];
    }
}