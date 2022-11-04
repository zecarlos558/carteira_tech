<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GrupoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'nome' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Nome do Grupo deve estar preenchido'
        ];
    }
}
