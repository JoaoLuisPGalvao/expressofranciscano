@extends('layouts.fichas')

@section('title', 'Ficha de Inscrição')

@section('content')    

    {{-- CABEÇALHO --}}
    <table class="header" width="100%">
        <tr>
            <td style="width: 100px; text-align: left;">
                <img src="{{ public_path('/img/logo_paroquia.png') }}" alt="Logo" class="logo">
            </td>
            <td style="text-align: center; padding-top: 15px;">
                <h3>PARÓQUIA SÃO FRANCISCO DE ASSIS</h3>
                <h3>Ficha de Inscrição</h3>
            </td>
            <td style="width: 100px; text-align: left;">
                <img src="{{ public_path('/img/logo_expresso.jpg') }}" alt="Logo" class="logo">
            </td>
        </tr>
    </table>

    {{-- DADOS PESSOAIS --}}
    <div class="section-title">DADOS PESSOAIS</div>
        <table>
            <tr>
                <td style="width:80%">
                    <table style="width:100%">
                        <tr>
                            <td style="width: 25%; font-weight: bold;">Nome:</td>
                            <td style="width: 75%;">{{ $adolecente->nome }}</td>
                        </tr>
                        <tr>
                            <td style="width: 25%; font-weight: bold;">Data de Nascimento:</td>
                            <td style="width: 75%;">{{ formatDate($adolecente->data_nasc) }}</td>
                        </tr>
                        <tr>
                            <td style="width: 25%; font-weight: bold;">Gênero:</td>
                            <td style="width: 75%;">{{ $generos[$adolecente->genero] ?? '' }}</td>
                        </tr>
                        <tr>
                            <td style="width: 25%; font-weight: bold;">Mora com:</td>
                            <td style="width: 75%;">{{ $adolecente->mora_com }}</td>
                        </tr>
                        <tr>
                            <td style="width: 25%; font-weight: bold;">Ano Expresso:</td>
                            <td style="width: 75%;">{{ $adolecente->ano_expresso }}</td>
                        </tr>
                        <tr>
                            <td style="width: 25%; font-weight: bold;">Inscrição:</td>
                            <td style="width: 75%;">{{ formatDateTime($adolecente->created_at) }}</td>
                        </tr>
                    </table>
                </td>
                <td style="width:20%; text-align:center;">
                    @if($adolecente->foto && Storage::disk('public')->exists($adolecente->foto))
                        <img src="{{ public_path('storage/' . $adolecente->foto) }}" class="foto">
                    @else
                        <div class="foto-box">Sem foto</div>
                    @endif
                </td>
            </tr>
        </table>       

    {{-- ENDEREÇO --}}
    <div class="section-title">ENDEREÇO</div>
        <table width="100%">
            <tr>
                <td style="width: 10%; font-weight: bold;">Rua:</td>
                <td style="width: 50%;">{{ $adolecente->endereco_rua }}</td>
                <td style="width: 10%; font-weight: bold;">Número:</td>
                <td style="width: 30%;">{{ $adolecente->endereco_numero }}</td>                
            </tr>
            <tr>                
                <td style="width: 10%; font-weight: bold;">Bairro:</td>
                <td style="width: 50%;">{{ $adolecente->endereco_bairro }}</td>
                <td style="width: 10%; font-weight: bold;">Cidade:</td>
                <td style="width: 30%;">{{ $adolecente->endereco_cidade }}</td> 
            </tr>
            <tr>
                <td style="width: 10%; font-weight: bold;">Estado:</td>
                <td style="width: 50%;">{{ $adolecente->endereco_estado }}</td>
                <td style="width: 10%; font-weight: bold;">CEP:</td>
                <td style="width: 30%;">{{ $adolecente->endereco_cep }}</td>              
            </tr>  
            <tr> 
                <td style="width: 10%; font-weight: bold;">Complemento:</td>
                <td colspan="3">{{ $adolecente->endereco_complemento }}</td>              
            </tr>            
        </table>

    {{-- ESCOLARIDADE --}}
    <div class="section-title">ESCOLARIDADE</div>
        <table width="100%">
            <tr>
                <td style="width: 10%; font-weight: bold;">Estuda ?</td>
                <td style="width: 25%;">{{ $simNao[$adolecente->estuda] ?? '' }}</td>
                <td style="width: 10%; font-weight: bold;">Escola:</td>
                <td style="width: 55%;">{{ $adolecente->escola }}</td>                
            </tr>
            <tr>                
                <td style="width: 10%; font-weight: bold;">Série:</td>
                <td style="width: 25%;">{{ $series[$adolecente->serie] ?? '' }}</td>
                <td style="width: 10%; font-weight: bold;">Turno:</td>
                <td style="width: 55%;">{{ $turnos[$adolecente->turno] ?? '' }}</td> 
            </tr>            
        </table>

    {{-- FAMÍLIA --}}
    <div class="section-title">FAMÍLIA</div>
        <table width="100%">
            <tr>
                <td colspan="2" style="width: 15%; font-weight: bold;">Tem irmãos ?</td>
                <td colspan="2" style="width: 45%;">{{ $irmaos[$adolecente->tem_irmaos] }}</td>
                <td colspan="2" style="width: 15%; font-weight: bold;">Pais casados ?</td>
                <td colspan="2" style="width: 25%;">{{ $simNao[$adolecente->pais_casados] ?? '' }}</td>
            </tr>
            <tr>
                <td colspan="2" style="width: 15%; font-weight: bold;">Nome do Pai:</td>
                <td colspan="2" style="width: 45%;">{{ $adolecente->pai_nome }}</td>
                <td colspan="2" style="width: 15%; font-weight: bold;">Contato:</td>
                <td colspan="2" style="width: 25%;">{{ $adolecente->pai_contato }}</td>
            </tr>
            <tr>
                <td colspan="2" style="width: 15%; font-weight: bold;">Nome da Mãe:</td>
                <td colspan="2" style="width: 45%;">{{ $adolecente->mae_nome }}</td>
                <td colspan="2" style="width: 15%; font-weight: bold;">Contato:</td>
                <td colspan="2" style="width: 25%;">{{ $adolecente->mae_contato }}</td>
            </tr>
            @if($adolecente->outro_responsavel_nome)
            <tr>
                <td colspan="2" style="width: 15%; font-weight: bold;">Outro Resp:</td>
                <td colspan="2" style="width: 45%;">{{ $adolecente->outro_responsavel_nome }} - {{ $adolecente->outro_responsavel_parentesco }}</td>
                <td colspan="2" style="width: 15%; font-weight: bold;">Contato:</td>
                <td colspan="2" style="width: 25%;">{{ $adolecente->outro_responsavel_contato }}</td>
            </tr>
             @endif
             <tr>
                <td colspan="2" style="width: 15%; font-weight: bold;">Contato Principal:</td>
                <td colspan="2" style="width: 45%;">{{ $contatos[$adolecente->contato_principal] ?? '' }}</td>
                <td colspan="2" style="width: 15%; font-weight: bold;">Possui Transporte ?</td>
                <td colspan="2" style="width: 25%;">{{ $transportes[$adolecente->possui_transporte] ?? '' }}</td>
            </tr>
        </table>    

    {{-- IGREJA E MOVIMENTOS --}}
    <div class="section-title">IGREJA E MOVIMENTOS</div>
        <table width="100%">
            <tr>
                <td style="width: 47%; font-weight: bold;">Algum Familiar participa de movimentos da igreja ?</td>
                <td style="width: 53%;">
                    {{ $simNao[$adolecente->familiar_participa] }}

                    @if($adolecente->familiar_participa == 1)
                        , {{ $adolecente->familiar_quem }} - {{ $adolecente->familiar_grupo }}
                    @endif                
                </td>                
            </tr>           
             <tr>
                <td style="width: 47%; font-weight: bold;">Algum parente também está fazendo a inscrição ?</td>
                <td style="width: 53%;">
                    {{ $simNao[$adolecente->tem_parente_inscrito] }} 
                    
                    @if($adolecente->tem_parente_inscrito == 1)
                        , {{ $adolecente->parente_inscrito_nome }} 
                    @endif
                </td>                
            </tr>            
        </table>

    {{-- SAÚDE --}}
    <div class="section-title">SAÚDE</div>
        <table width="100%">
            <tr>
                <td style="width: 30%; font-weight: bold;">Faz uso de medicamento ?</td>
                <td style="width: 70%;">
                    {{ $simNao[$adolecente->uso_medicamento] }}

                    @if($adolecente->uso_medicamento == 1)
                        , {{ $adolecente->uso_medicamento_descricao }}
                    @endif                
                </td>                
            </tr>   
            <tr>
                <td style="width: 30%; font-weight: bold;">Faz tratamento de saúde ?</td>
                <td style="width: 70%;">
                    {{ $simNao[$adolecente->tratamento_saude] }}

                    @if($adolecente->tratamento_saude == 1)
                        , {{ $adolecente->tratamento_saude_descricao }}
                    @endif                
                </td>                
            </tr>   
            <tr>
                <td style="width: 30%; font-weight: bold;">Possui restrição alimentar ?</td>
                <td style="width: 70%;">
                    {{ $simNao[$adolecente->restricao_alimentar] }}

                    @if($adolecente->restricao_alimentar == 1)
                        , {{ $adolecente->restricao_alimentar_descricao }}
                    @endif                
                </td>                
            </tr>  
            <tr>
                <td style="width: 30%; font-weight: bold;">Possui alergia(s) ?</td>
                <td style="width: 70%;">
                    {{ $simNao[$adolecente->alergia] }}

                    @if($adolecente->alergia == 1)
                        , {{ $adolecente->alergia_descricao }}
                    @endif                
                </td>                
            </tr>
            <tr>
                <td style="width: 30%; font-weight: bold;">Possui Espectro Autista ?</td>
                <td style="width: 70%;">
                    {{ $simNao[$adolecente->espectro_autista] }}

                    @if($adolecente->espectro_autista == 1)
                        , {{ $adolecente->espectro_autista_descricao }}
                    @endif                
                </td>                
            </tr>
        </table>
@endsection

{{-- RODAPÉ --}}
@section('footer')
    <table width="100%">
        <tr>
            <td style="text-align: left; font-size:10px; line-height:1.4;">
                <strong>Paróquia São Francisco de Assis</strong><br>
                Rua São Francisco de Assis, 195 – Bairro Conceição<br>
                Campina Grande - PB, CEP 58401-279<br>
                Tel: (83) 3341-5429 | paroquiasaofranciscodeassiscg@gmail.com<br>
                Instagram: @paroquiasaofranciscodeassiscg
            </td>
            <td style="text-align: right; font-size:10px; vertical-align: bottom;">
                <em>“Paz e Bem!”</em><br>
                Página <span class="page-number"></span><span class="page-total"></span>
            </td>
        </tr>
    </table>
@endsection
