<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'nome' => ['required'],
            'grupo' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Nome da Categoria deve estar preenchido',
            'grupo.required' => 'Grupo da Categoria deve estar preenchido'
        ];
    }
}
