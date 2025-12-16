<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContaRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        // remover máscara de valor antes da validação
        $this->merge([
            'valor' => str_replace(',', '.', str_replace('.', '', $this->valor))
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'nome' => ['required'],
            'tipo' => ['required'],
            'valor' => ['required'],
            'valor' => ['numeric']
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Nome da Conta deve estar preenchido',
            'tipo.required' => 'Tipo da Conta deve estar preenchido',
            'valor.required' => 'Valor da conta deve estar preenchido',
            'valor.numeric' => 'Valor da Conta deve ser do tipo numérico'
        ];
    }
}
