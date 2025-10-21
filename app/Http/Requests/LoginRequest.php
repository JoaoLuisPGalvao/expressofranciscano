<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        $rules = [
            'email'     => 'required',
            'password'  => 'required',
        ];
    
        if (!app()->environment('local')) {
            $rules['g-recaptcha-response'] = 'required|captcha';
        }
    
        return $rules;
    }

    public function messages(): array{

        return [
            'email.required'    => 'O campo E-MAIL é obrigatório',
            'password.required' => 'O Campo SENHA é obrigatório',
            'g-recaptcha-response.required' => 'Confirme que você não é um robô',
            'g-recaptcha-response.captcha'  => 'Falha na verificação do reCAPTCHA',
        ];
    }
}
