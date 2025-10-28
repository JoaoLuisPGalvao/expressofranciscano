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
        return [
            // Dados pessoais
            'nome'                          => 'required|string|max:255',            
            'data_nasc'                     => 'required|date',
            'genero'                        => 'required|integer',
            'ano_expresso'                  => 'required|digits:4|integer',

            // Endereço
            'endereco_cep'                  => 'required|string|max:10',
            'endereco_rua'                  => 'required|string|max:255',
            'endereco_numero'               => 'nullable|string|max:10',
            'endereco_bairro'               => 'required|string|max:255',
            'endereco_cidade'               => 'required|string|max:255',
            'endereco_estado'               => 'required|string|size:2',
            'endereco_complemento'          => 'nullable|string|max:255',

            // Escolaridade
            'estuda'                        => 'required|integer',
            'escola'                        => 'required_if:estuda,1|string|max:255',
            'serie'                         => 'required_if:estuda,1|integer',
            'turno'                         => 'required_if:estuda,1|integer',

            // Família
            'tem_irmaos'                    => 'required|integer',
            'pais_casados'                  => 'required|integer',
            'mora_com'                       => 'required|string|max:255',

            // Responsáveis
            'pai_nome'                       => 'nullable|string|max:255',
            'pai_contato'                    => 'nullable|string|max:30',
            'mae_nome'                       => 'required|string|max:255',
            'mae_contato'                    => 'required|string|max:30',
            'outro_responsavel_nome'         => 'nullable|string|max:255',
            'outro_responsavel_contato'      => 'nullable|string|max:30',
            'outro_responsavel_parentesco'   => 'nullable|string|max:50',
            'contato_principal'              => 'required|integer',
            'possui_transporte'              => 'required|integer',

            // Igreja / Movimentos
            'familiar_participa'             => 'required|integer',
            'familiar_quem'                  => 'required_if:familiar_participa,1|string|max:255',
            'familiar_grupo'                 => 'required_if:familiar_participa,1|string|max:255',
            'tem_parente_inscrito'           => 'required|integer',
            'parente_inscrito_nome'          => 'required_if:tem_parente_inscrito,1|string|max:255',

            // Saúde
            'uso_medicamento'                => 'required|integer',
            'uso_medicamento_descricao'      => 'required_if:uso_medicamento,1|string|max:500',
            'tratamento_saude'               => 'required|integer',
            'tratamento_saude_descricao'     => 'required_if:tratamento_saude,1|string|max:500',
            'restricao_alimentar'            => 'required|integer',
            'restricao_alimentar_descricao'  => 'required_if:restricao_alimentar,1|string|max:500',
            'alergia'                        => 'required|integer',
            'alergia_descricao'              => 'required_if:alergia,1|string|max:500',

            // Necessidades especiais
            'espectro_autista'               => 'required|integer',
            'espectro_autista_descricao'     => 'required_if:espectro_autista,1|string|max:500',

            // Foto
            'foto'                           => 'nullable|image|mimes:jpg,jpeg,png|max:300', // 300KB
        ];
    }

    public function messages(): array
    {
        return [
            // Dados pessoais
            'nome.required' => 'O campo Nome é obrigatório.',
            'nome.string'   => 'O campo Nome deve conter texto válido.',
            'nome.max'      => 'O campo Nome pode ter no máximo 255 caracteres.',

            'data_nasc.required' => 'Informe a data de nascimento.',
            'data_nasc.date'     => 'A data de nascimento deve ser uma data válida.',

            'genero.required' => 'Selecione o gênero.',
            'genero.integer'  => 'Valor inválido para o campo Gênero.',

            'ano_expresso.required' => 'Informe o ano do Expresso.',
            'ano_expresso.digits'   => 'O campo Ano deve conter 4 dígitos.',
            'ano_expresso.integer'  => 'O campo Ano deve conter apenas números.',

            // Endereço
            'endereco_cep.required' => 'O campo CEP é obrigatório.',
            'endereco_cep.string'   => 'O campo CEP deve ser um valor válido.',
            'endereco_cep.max'      => 'O campo CEP pode ter no máximo 10 caracteres.',

            'endereco_rua.required' => 'O campo Rua é obrigatório.',
            'endereco_rua.string'   => 'O campo Rua deve conter texto válido.',
            'endereco_rua.max'      => 'O campo Rua pode ter no máximo 255 caracteres.',

            'endereco_numero.string' => 'O campo Número deve conter texto válido.',
            'endereco_numero.max'    => 'O campo Número pode ter no máximo 10 caracteres.',

            'endereco_bairro.required'  => 'O campo Bairro é obrigatório.',
            'endereco_bairro.string'    => 'O campo Bairro deve conter texto válido.',
            'endereco_bairro.max'       => 'O campo Bairro pode ter no máximo 255 caracteres.',

            'endereco_cidade.required'  => 'O campo Cidade é obrigatório.',
            'endereco_cidade.string'    => 'O campo Cidade deve conter texto válido.',
            'endereco_cidade.max'       => 'O campo Cidade pode ter no máximo 255 caracteres.',

            'endereco_estado.required'  => 'O campo Estado é obrigatório.',
            'endereco_estado.string'    => 'O campo Estado deve conter texto válido.',
            'endereco_estado.size'      => 'Informe apenas a sigla do estado, por exemplo: PB, SP, RJ.',

            'endereco_complemento.string'   => 'O campo Complemento deve conter texto válido.',
            'endereco_complemento.max'      => 'O campo Complemento pode ter no máximo 255 caracteres.',

            // Escolaridade
            'estuda.required' => 'Informe se o encontrista estuda.',
            'estuda.integer'  => 'Valor inválido para o campo Estuda.',

            'escola.required_if' => 'Informe o nome da escola, pois o encontrista estuda.',
            'escola.string'      => 'O campo Escola deve conter texto válido.',
            'escola.max'         => 'O campo Escola pode ter no máximo 255 caracteres.',

            'serie.required_if' => 'Informe a série do encontrista.',
            'serie.integer'     => 'O campo Série deve conter apenas números.',

            'turno.required_if' => 'Informe o turno escolar do encontrista.',
            'turno.integer'     => 'Valor inválido para o campo Turno.',

            // Família
            'tem_irmaos.required' => 'Informe se o encontrista tem irmãos.',
            'tem_irmaos.integer'  => 'Valor inválido para o campo Tem Irmãos.',

            'pais_casados.required' => 'Informe se os pais são casados.',
            'pais_casados.integer'  => 'Valor inválido para o campo Pais Casados.',

            'mora_com.required' => 'Informe com quem o encontrista mora.',
            'mora_com.string'   => 'O campo Mora Com deve conter texto válido.',
            'mora_com.max'      => 'O campo Mora Com pode ter no máximo 255 caracteres.',

            // Responsáveis
            'pai_nome.string' => 'O campo Nome do Pai deve conter texto válido.',
            'pai_nome.max'    => 'O campo Nome do Pai pode ter no máximo 255 caracteres.',

            'pai_contato.string' => 'O campo Contato do Pai deve conter um valor válido.',
            'pai_contato.max'    => 'O campo Contato do Pai pode ter no máximo 30 caracteres.',

            'mae_nome.required' => 'O campo Nome da Mãe é obrigatório.',
            'mae_nome.string'   => 'O campo Nome da Mãe deve conter texto válido.',
            'mae_nome.max'      => 'O campo Nome da Mãe pode ter no máximo 255 caracteres.',

            'mae_contato.required' => 'O campo Contato da Mãe é obrigatório.',
            'mae_contato.string'   => 'O campo Contato da Mãe deve conter um valor válido.',
            'mae_contato.max'      => 'O campo Contato da Mãe pode ter no máximo 30 caracteres.',

            'outro_responsavel_nome.string' => 'O campo Nome do Outro Responsável deve conter texto válido.',
            'outro_responsavel_nome.max'    => 'O campo Nome do Outro Responsável pode ter no máximo 255 caracteres.',

            'outro_responsavel_contato.string' => 'O campo Contato do Outro Responsável deve conter um valor válido.',
            'outro_responsavel_contato.max' => 'O campo Contato do Outro Responsável pode ter no máximo 30 caracteres.',

            'outro_responsavel_parentesco.string' => 'O campo Parentesco deve conter texto válido.',
            'outro_responsavel_parentesco.max'    => 'O campo Parentesco pode ter no máximo 50 caracteres.',

            'contato_principal.required' => 'Selecione o contato principal.',
            'contato_principal.integer'  => 'Valor inválido para o campo Contato Principal.',

            'possui_transporte.required' => 'Informe se o encontrista possui transporte.',
            'possui_transporte.integer'  => 'Valor inválido para o campo Possui Transporte.',

            // Igreja / Movimentos
            'familiar_participa.required' => 'Informe se algum familiar participa de grupo ou movimento.',
            'familiar_participa.integer'  => 'Valor inválido para o campo Familiar Participa.',

            'familiar_quem.required_if' => 'Informe quem participa do grupo, pois há familiar participante.',
            'familiar_quem.string'      => 'O campo Quem deve conter texto válido.',
            'familiar_quem.max'         => 'O campo Quem pode ter no máximo 255 caracteres.',

            'familiar_grupo.required_if' => 'Informe o grupo ou movimento do familiar.',
            'familiar_grupo.string'      => 'O campo Grupo deve conter texto válido.',
            'familiar_grupo.max'         => 'O campo Grupo pode ter no máximo 255 caracteres.',

            'tem_parente_inscrito.required' => 'Informe se há algum parente inscrito.',
            'tem_parente_inscrito.integer'  => 'Valor inválido para o campo Tem Parente Inscrito.',

            'parente_inscrito_nome.required_if' => 'Informe o nome do parente inscrito.',
            'parente_inscrito_nome.string'      => 'O campo Nome do Parente deve conter texto válido.',
            'parente_inscrito_nome.max'         => 'O campo Nome do Parente pode ter no máximo 255 caracteres.',

            // Saúde
            'uso_medicamento.required'  => 'Informe se o encontrista faz uso de medicamento.',
            'uso_medicamento.integer'   => 'Valor inválido para o campo Uso de Medicamento.',
            'uso_medicamento_descricao.required_if' => 'Descreva os medicamentos utilizados.',
            'uso_medicamento_descricao.string'      => 'A descrição dos medicamentos deve conter texto válido.',
            'uso_medicamento_descricao.max'         => 'A descrição dos medicamentos pode ter no máximo 255 caracteres.',

            'tratamento_saude.required' => 'Informe se o encontrista está em tratamento de saúde.',
            'tratamento_saude.integer'  => 'Valor inválido para o campo Tratamento de Saúde.',
            'tratamento_saude_descricao.required_if' => 'Descreva o tratamento de saúde.',
            'tratamento_saude_descricao.string'      => 'A descrição do tratamento deve conter texto válido.',
            'tratamento_saude_descricao.max'         => 'A descrição do tratamento pode ter no máximo 255 caracteres.',

            'restricao_alimentar.required' => 'Informe se o encontrista possui restrição alimentar.',
            'restricao_alimentar.integer'  => 'Valor inválido para o campo Restrição Alimentar.',
            'restricao_alimentar_descricao.required_if' => 'Descreva a restrição alimentar.',
            'restricao_alimentar_descricao.string'      => 'A descrição da restrição alimentar deve conter texto válido.',
            'restricao_alimentar_descricao.max'         => 'A descrição da restrição alimentar pode ter no máximo 255 caracteres.',

            'alergia.required' => 'Informe se o encontrista possui alergias.',
            'alergia.integer'  => 'Valor inválido para o campo Alergia.',
            'alergia_descricao.required_if' => 'Descreva a(s) alergia(s).',
            'alergia_descricao.string'      => 'A descrição da alergia deve conter texto válido.',
            'alergia_descricao.max'         => 'A descrição da alergia pode ter no máximo 255 caracteres.',

            // Necessidades especiais
            'espectro_autista.required' => 'Informe se o encontrista está no espectro autista.',
            'espectro_autista.integer'  => 'Valor inválido para o campo Espectro Autista.',
            'espectro_autista_descricao.required_if' => 'Descreva as necessidades relacionadas ao espectro autista.',
            'espectro_autista_descricao.string'      => 'A descrição do espectro deve conter texto válido.',
            'espectro_autista_descricao.max'         => 'A descrição do espectro pode ter no máximo 500 caracteres.',

            // Foto
            'foto.image' => 'O arquivo deve ser uma imagem válida.',
            'foto.mimes' => 'A imagem deve estar no formato JPG ou PNG.',
            'foto.max'   => 'Tamanho máximo da imagem: 300KB.',
        ];
    }
}