<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'nome.required' => 'Nome da Função deve estar preenchido'
        ];
    }
}
