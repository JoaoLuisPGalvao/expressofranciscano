@extends('layouts.fichas')

@section('title', 'Ficha Cadastral')

@section('content') 
    @foreach ($encontristas as $encontrista)
        {{-- CABEÇALHO --}}
        <table class="header" width="100%">
            <tr>
                <td style="width: 100px; text-align: left;">
                    <img src="{{ public_path('/img/logo_paroquia.png') }}" alt="Logo" class="logo">
                </td>
                <td style="text-align: center; padding-top: 15px;">
                    <h3>PARÓQUIA SÃO FRANCISCO DE ASSIS</h3>
                    <h3>Ficha Cadastral</h3>
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
                                <td style="width: 75%;">{{ $encontrista->nome }}</td>
                            </tr>
                            <tr>
                                <td style="width: 25%; font-weight: bold;">Data de Nascimento:</td>
                                <td style="width: 75%;">{{ formatDate($encontrista->data_nasc) }}</td>
                            </tr>
                            <tr>
                                <td style="width: 25%; font-weight: bold;">Gênero:</td>
                                <td style="width: 75%;">{{ $generos[$encontrista->genero] ?? '' }}</td>
                            </tr>
                            <tr>
                                <td style="width: 25%; font-weight: bold;">Mora com:</td>
                                <td style="width: 75%;">{{ $encontrista->mora_com }}</td>
                            </tr>
                            <tr>
                                <td style="width: 25%; font-weight: bold;">Ano Expresso:</td>
                                <td style="width: 75%;">{{ $encontrista->ano_expresso }}</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width:20%; text-align:center;">
                        @if($encontrista->foto && Storage::disk('public')->exists($encontrista->foto))
                            <img src="{{ public_path('storage/' . $encontrista->foto) }}" class="foto">
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
                    <td style="width: 50%;">{{ $encontrista->endereco_rua }}</td>
                    <td style="width: 10%; font-weight: bold;">Número:</td>
                    <td style="width: 30%;">{{ $encontrista->endereco_numero }}</td>                
                </tr>
                <tr>                
                    <td style="width: 10%; font-weight: bold;">Bairro:</td>
                    <td style="width: 50%;">{{ $encontrista->endereco_bairro }}</td>
                    <td style="width: 10%; font-weight: bold;">Cidade:</td>
                    <td style="width: 30%;">{{ $encontrista->endereco_cidade }}</td> 
                </tr>
                <tr>
                    <td style="width: 10%; font-weight: bold;">Estado:</td>
                    <td style="width: 50%;">{{ $encontrista->endereco_estado }}</td>
                    <td style="width: 10%; font-weight: bold;">CEP:</td>
                    <td style="width: 30%;">{{ $encontrista->endereco_cep }}</td>              
                </tr>  
                <tr> 
                    <td style="width: 10%; font-weight: bold;">Complemento:</td>
                    <td colspan="3">{{ $encontrista->endereco_complemento }}</td>              
                </tr>            
            </table>

        {{-- ESCOLARIDADE --}}
        <div class="section-title">ESCOLARIDADE</div>
            <table width="100%">
                <tr>
                    <td style="width: 10%; font-weight: bold;">Estuda ?</td>
                    <td style="width: 25%;">{{ $simNao[$encontrista->estuda] ?? '' }}</td>
                    <td style="width: 10%; font-weight: bold;">Escola:</td>
                    <td style="width: 55%;">{{ $encontrista->escola }}</td>                
                </tr>
                <tr>                
                    <td style="width: 10%; font-weight: bold;">Série:</td>
                    <td style="width: 25%;">{{ $series[$encontrista->serie] }}</td>
                    <td style="width: 10%; font-weight: bold;">Turno:</td>
                    <td style="width: 55%;">{{ $turnos[$encontrista->turno] ?? '' }}</td> 
                </tr>            
            </table>

        {{-- FAMÍLIA --}}
        <div class="section-title">FAMÍLIA</div>
            <table width="100%">
                <tr>
                    <td colspan="2" style="width: 15%; font-weight: bold;">Tem irmãos ?</td>
                    <td colspan="2" style="width: 45%;">{{ $irmaos[$encontrista->tem_irmaos] }}</td>
                    <td colspan="2" style="width: 15%; font-weight: bold;">Pais casados ?</td>
                    <td colspan="2" style="width: 25%;">{{ $simNao[$encontrista->pais_casados] ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="width: 15%; font-weight: bold;">Nome do Pai:</td>
                    <td colspan="2" style="width: 45%;">{{ $encontrista->pai_nome }}</td>
                    <td colspan="2" style="width: 15%; font-weight: bold;">Contato:</td>
                    <td colspan="2" style="width: 25%;">{{ $encontrista->pai_contato }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="width: 15%; font-weight: bold;">Nome da Mãe:</td>
                    <td colspan="2" style="width: 45%;">{{ $encontrista->mae_nome }}</td>
                    <td colspan="2" style="width: 15%; font-weight: bold;">Contato:</td>
                    <td colspan="2" style="width: 25%;">{{ $encontrista->mae_contato }}</td>
                </tr>
                @if($encontrista->outro_responsavel_nome)
                <tr>
                    <td colspan="2" style="width: 15%; font-weight: bold;">Outro Resp:</td>
                    <td colspan="2" style="width: 45%;">{{ $encontrista->outro_responsavel_nome }} - {{ $encontrista->outro_responsavel_parentesco }}</td>
                    <td colspan="2" style="width: 15%; font-weight: bold;">Contato:</td>
                    <td colspan="2" style="width: 25%;">{{ $encontrista->outro_responsavel_contato }}</td>
                </tr>
                @endif
                <tr>
                    <td colspan="2" style="width: 15%; font-weight: bold;">Contato Principal:</td>
                    <td colspan="2" style="width: 45%;">{{ $contatos[$encontrista->contato_principal] ?? '' }}</td>
                    <td colspan="2" style="width: 15%; font-weight: bold;">Possui Transporte ?</td>
                    <td colspan="2" style="width: 25%;">{{ $transportes[$encontrista->possui_transporte] ?? '' }}</td>
                </tr>
            </table>    

        {{-- IGREJA E MOVIMENTOS --}}
        <div class="section-title">IGREJA E MOVIMENTOS</div>
            <table width="100%">
                <tr>
                    <td style="width: 47%; font-weight: bold;">Algum Familiar participa de movimentos da igreja ?</td>
                    <td style="width: 53%;">
                        {{ $simNao[$encontrista->familiar_participa] }}

                        @if($encontrista->familiar_participa == 1)
                            , {{ $encontrista->familiar_quem }} - {{ $encontrista->familiar_grupo }}
                        @endif                
                    </td>                
                </tr>           
                <tr>
                    <td style="width: 47%; font-weight: bold;">Algum parente também está fazendo a inscrição ?</td>
                    <td style="width: 53%;">
                        {{ $simNao[$encontrista->tem_parente_inscrito] }} 
                        
                        @if($encontrista->tem_parente_inscrito == 1)
                            , {{ $encontrista->parente_inscrito_nome }} 
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
                        {{ $simNao[$encontrista->uso_medicamento] }}

                        @if($encontrista->uso_medicamento == 1)
                            , {{ $encontrista->uso_medicamento_descricao }}
                        @endif                
                    </td>                
                </tr>   
                <tr>
                    <td style="width: 30%; font-weight: bold;">Faz tratamento de saúde ?</td>
                    <td style="width: 70%;">
                        {{ $simNao[$encontrista->tratamento_saude] }}

                        @if($encontrista->tratamento_saude == 1)
                            , {{ $encontrista->tratamento_saude_descricao }}
                        @endif                
                    </td>                
                </tr>   
                <tr>
                    <td style="width: 30%; font-weight: bold;">Possui restrição alimentar ?</td>
                    <td style="width: 70%;">
                        {{ $simNao[$encontrista->restricao_alimentar] }}

                        @if($encontrista->restricao_alimentar == 1)
                            , {{ $encontrista->restricao_alimentar_descricao }}
                        @endif                
                    </td>                
                </tr>  
                <tr>
                    <td style="width: 30%; font-weight: bold;">Possui alergia(s) ?</td>
                    <td style="width: 70%;">
                        {{ $simNao[$encontrista->alergia] }}

                        @if($encontrista->alergia == 1)
                            , {{ $encontrista->alergia_descricao }}
                        @endif                
                    </td>                
                </tr>
                <tr>
                    <td style="width: 30%; font-weight: bold;">Possui Espectro Autista ?</td>
                    <td style="width: 70%;">
                        {{ $simNao[$encontrista->espectro_autista] }}

                        @if($encontrista->espectro_autista == 1)
                            , {{ $encontrista->espectro_autista_descricao }}
                        @endif                
                    </td>                
                </tr>
            </table>

        @if (!$loop->last)
            <div style="page-break-after: always;"></div>
        @endif
    @endforeach
@endsection

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
