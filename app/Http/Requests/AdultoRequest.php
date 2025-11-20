<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdultoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Dados pessoais
            'nome'               => 'required|string|max:255',
            'perfil'             => 'required|integer',
            'idade'              => 'required|string|max:10',
            'ano_expresso'       => 'required|digits:4|integer',

            // Endereço
            'endereco_cep'          => 'required|string|max:10',
            'endereco_rua'          => 'required|string|max:255',
            'endereco_numero'       => 'nullable|string|max:10',
            'endereco_bairro'       => 'required|string|max:255',
            'endereco_cidade'       => 'required|string|max:255',
            'endereco_estado'       => 'required|string|size:2',
            'endereco_complemento'  => 'nullable|string|max:255',

            // Contato
            'contato'            => 'nullable|string|max:35',
            'instagram'          => 'nullable|string|max:255',

            // Igreja
            'frequenta_paroquia' => 'required|integer',
            'qual_paroquia'      => 'nullable|string|max:255',

            // Expresso (histórico)
            'participou_expresso' => 'required|integer',
            'ano_participacao'    => 'nullable|string|max:10',

            // Expresso (serviço)
            'serviu_expresso'     => 'required|integer',
            'experiencias_servico'=> 'nullable|string|max:500',

            // Vagão(s)
            'vagao_1'            => 'required|integer',
            'vagao_2'            => 'nullable|integer',
            'vagao_3'            => 'nullable|integer',

            // Pastoral
            'participa_pastoral' => 'required|integer',
            'qual_pastoral'      => 'nullable|string|max:255',

            // EJC / ECC
            'serviu_ejc_ecc'     => 'required|integer',

            // Foto
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:300', // 300 KB
        ];
    }


    public function messages(): array
    {
        return [

            //Dados Pessoais            
            'nome.required' => 'O campo Nome é obrigatório.',
            'nome.string'   => 'O campo Nome deve conter texto válido.',
            'nome.max'      => 'O campo Nome pode ter no máximo 255 caracteres.',

            'perfil.required' => 'O campo Perfil é obrigatório.',
            'perfil.integer'  => 'Valor inválido para o campo Perfil.',

            'idade.required' => 'O campo Idade é obrigatório.',
            'idade.string'   => 'O campo Idade deve conter texto válido.',
            'idade.max'      => 'O campo Idade pode ter no máximo 10 caracteres.',

            'ano_expresso.required' => 'Informe o ano do Expresso.',
            'ano_expresso.digits'   => 'O Ano do Expresso deve conter 4 dígitos.',
            'ano_expresso.integer'  => 'O Ano do Expresso deve conter apenas números.',

            //Endereço
            'endereco_cep.required' => 'O campo CEP é obrigatório.',
            'endereco_cep.string'   => 'O campo CEP deve conter texto válido.',
            'endereco_cep.max'      => 'O campo CEP pode ter no máximo 10 caracteres.',

            'endereco_rua.required' => 'O campo Rua é obrigatório.',
            'endereco_rua.string'   => 'O campo Rua deve conter texto válido.',
            'endereco_rua.max'      => 'O campo Rua pode ter no máximo 255 caracteres.',

            'endereco_numero.string' => 'O Número deve conter texto válido.',
            'endereco_numero.max'    => 'O Número pode ter no máximo 10 caracteres.',

            'endereco_bairro.required' => 'O campo Bairro é obrigatório.',
            'endereco_bairro.string'   => 'O campo Bairro deve conter texto válido.',
            'endereco_bairro.max'      => 'O campo Bairro pode ter no máximo 255 caracteres.',

            'endereco_cidade.required' => 'O campo Cidade é obrigatório.',
            'endereco_cidade.string'   => 'O campo Cidade deve conter texto válido.',
            'endereco_cidade.max'      => 'O campo Cidade pode ter no máximo 255 caracteres.',

            'endereco_estado.required' => 'O campo Estado é obrigatório.',
            'endereco_estado.string'   => 'O campo Estado deve conter texto válido.',
            'endereco_estado.size'     => 'Informe apenas a sigla do estado (ex.: PB, SP, RJ).',

            'endereco_complemento.string' => 'O campo Complemento deve conter texto válido.',
            'endereco_complemento.max'    => 'O campo Complemento pode ter no máximo 255 caracteres.',

            //Contato            
            'contato.string' => 'O campo Contato deve conter um valor válido.',
            'contato.max'    => 'O campo Contato pode ter no máximo 30 caracteres.',

            'instagram.string' => 'O campo Instagram deve conter texto válido.',
            'instagram.max'    => 'O campo Instagram pode ter no máximo 255 caracteres.',

            //Igreja            
            'frequenta_paroquia.required' => 'Informe se o adulto frequenta uma paróquia.',
            'frequenta_paroquia.integer'  => 'Valor inválido para o campo Frequenta Paróquia.',

            'qual_paroquia.string' => 'O campo Qual Paróquia deve conter texto válido.',
            'qual_paroquia.max'    => 'O campo Qual Paróquia pode ter no máximo 255 caracteres.',

            //Expresso (Histórico)
            'participou_expresso.required' => 'Informe se o adulto já participou do Expresso.',
            'participou_expresso.integer'  => 'Valor inválido para o campo Participou do Expresso.',

            'ano_participacao.string' => 'O campo Ano de Participação deve conter texto válido.',
            'ano_participacao.max'    => 'O Ano de Participação pode ter no máximo 10 caracteres.',

            //Expresso (Serviço)           
            'serviu_expresso.required' => 'Informe se o adulto já serviu no Expresso.',
            'serviu_expresso.integer'  => 'Valor inválido para o campo Serviu no Expresso.',

            'experiencias_servico.string' => 'O campo Experiências de Serviço deve conter texto válido.',
            'experiencias_servico.max'    => 'O campo Experiências de Serviço pode ter no máximo 500 caracteres.',

            //Vagões            
            'vagao_1.required' => 'Selecione pelo menos um vagão.',
            'vagao_1.integer'  => 'Valor inválido para o campo Vagão 1.',

            'vagao_2.integer' => 'Valor inválido para o campo Vagão 2.',
            'vagao_3.integer' => 'Valor inválido para o campo Vagão 3.',

            //Pastoral
            'participa_pastoral.required' => 'Informe se participa de alguma pastoral.',
            'participa_pastoral.integer'  => 'Valor inválido para o campo Participa Pastoral.',

            'qual_pastoral.string' => 'O campo Qual Pastoral deve conter texto válido.',
            'qual_pastoral.max'    => 'O campo Qual Pastoral pode ter no máximo 255 caracteres.',

            //EJC / ECC
            'serviu_ejc_ecc.required' => 'Informe se já serviu no EJC ou ECC.',
            'serviu_ejc_ecc.integer'  => 'Valor inválido para o campo Serviu EJC/ECC.',

            //Foto            
            'foto.image' => 'O arquivo enviado deve ser uma imagem válida.',
            'foto.mimes' => 'A imagem deve estar no formato JPG ou PNG.',
            'foto.max'   => 'A imagem pode ter no máximo 300 KB.',
        ];
    }
}