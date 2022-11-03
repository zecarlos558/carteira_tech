<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UsuarioRequest extends FormRequest
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
            'email' => ['required','unique:users,email'],
            'funcao' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Nome do Usuário deve estar preenchido',
            'email.required' => 'Email do Usuário deve estar preenchido',
            'email.unique' => 'Este Email já está cadastrado.',
            'funcao.required' => 'Nível de Função deve estar selecionada',
            'password.required' => 'Senha do Usuário deve estar preenchido',
            'password.confirmed' => 'A confirmação da senha não corresponde',
            'password.min' => 'A senha deve conter pelo menos 8 caracteres'
        ];
    }
}
