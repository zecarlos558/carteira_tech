<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovimentoRequest extends FormRequest
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
            'valor' => ['required'],
            'conta' => ['required'],
            'data' => ['required'],
            'categoria' => ['required'],
            'valor' => ['required'],
            'valor' => ['numeric']
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Nome do Movimento deve estar preenchido',
            'valor.required' => 'Valor do Movimento deve estar preenchido',
            'data.required' => 'Data do Movimento deve estar preenchido',
            'conta.required' => 'Conta do Movimento deve estar preenchido',
            'categoria.required' => 'Categoria do Movimento deve estar preenchido',
            'valor.required' => 'Valor da Conta deve estar preenchido',
            'valor.numeric' => 'Valor da Conta deve ser do tipo numérico'
        ];
    }
}
