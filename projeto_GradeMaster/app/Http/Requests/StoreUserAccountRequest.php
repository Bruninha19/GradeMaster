<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome_completo' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user_accounts,email',
            'senha' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
            ],
            'senha_confirmation' => 'required|string|min:8'
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Este e-mail já está cadastrado',
            'senha.confirmed' => 'As senhas não coincidem',
            'senha.min' => 'A senha deve ter no mínimo 8 caracteres'
        ];
    }
}