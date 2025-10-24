<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Captura o ID do usuário atual na rota (ex: users/{user})
        $userId = $this->route('user');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $userId,
            ],
            'password' => [                
                Rule::requiredIf($this->isMethod('post')),
                'string',
                'min:6',
                'confirmed',
            ],
            'nivel' => ['required', 'integer'],
            'equipe' => ['nullable', 'integer'],
            'status' => [
                Rule::requiredIf($this->isMethod('put')),
                'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está sendo utilizado.',
            'password.required' => 'A senha é obrigatória no cadastro.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
            'password.confirmed' => 'A confirmação da senha não confere.',
            'nivel.required' => 'O nível de acesso é obrigatório.',
            'nivel.integer' => 'O nível deve ser um número inteiro.',            
            'equipe.integer' => 'O campo equipe deve ser um número inteiro.',
            'status.required' => 'O status é obrigatório.',
            'status.integer' => 'O status deve ser um número inteiro.',            
        ];
    }
}
