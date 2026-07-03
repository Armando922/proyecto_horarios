<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sigla' => ['required', 'string', 'max:10', 'unique:subjects,sigla,' . $this->route('subject')->id],
            'nombre' => ['required', 'string', 'max:255'],
        ];
    }

    public function attributes(): array
    {
        return [
            'sigla' => 'sigla',
            'nombre' => 'nombre',
        ];
    }
}
