<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EncontristaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {       
        $rules = [
            'nome'              => 'required|string|max:255',
            'cpf'               => ['sometimes','string','size:14',Rule::unique('encontristas', 'cpf')->ignore($this->encontrista?->id),],
            'data_nasc'         => 'required|date',
            'genero'            => 'required|integer',
            'ano_expresso'      => 'required|integer|digits:4',
            'pai_nome'          => 'nullable|string|max:255',
            'pai_contato'       => 'nullable|string|max:30',
            'mae_nome'          => 'required|string|max:255',
            'mae_contato'       => 'required|string|max:30',
            'pais_casados'      => 'required|integer',
            'endereco_rua'      => 'required|string|max:255',
            'endereco_numero'   => 'nullable|string|max:10',
            'endereco_bairro'   => 'required|string|max:255',
            'endereco_cidade'   => 'required|string|max:255',
            'endereco_estado'   => 'required|string|max:255',
            'endereco_cep'      => 'required|string|max:10',            
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo Nome é obrigatório.',
            'cpf.size' => 'O CPF deve ter 14 caracteres (formato: 000.000.000-00).',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'data_nasc.required' => 'Informe a data de nascimento.',
            'data_nasc.date' => 'A data de nascimento deve ser uma data válida.',
            'ano_expresso.required' => 'Informe o ano do Expresso.',
            'ano_expresso.digits' => 'O campo Ano deve conter 4 dígitos.',
            'mae_nome.required' => 'O campo Nome da Mãe é obrigatório.',
            'mae_contato.required' => 'O campo Contato da Mãe é obrigatório.',
            'endereco_rua.required' => 'O campo Rua é obrigatório.',
            'endereco_bairro.required' => 'O campo Bairro é obrigatório.',
            'endereco_cidade.required' => 'O campo Cidade é obrigatório.',
            'endereco_estado.required' => 'O campo Estado é obrigatório.',
            'endereco_cep.required' => 'O campo CEP é obrigatório.',
            'foto.image' => 'O arquivo deve ser uma imagem válida.',
            'foto.mimes' => 'A imagem deve estar no formato JPG ou PNG.',
            'foto.max' => 'Tamanho máximo da imagem: 300KB.',
        ];
    }
}
