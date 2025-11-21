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
                <h3>Ficha de Inscrição - Adultos</h3>
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
                            <td style="width: 20%; font-weight: bold;">Nome:</td>
                            <td style="width: 80%;">{{ $adulto->nome }}</td>
                        </tr>
                        <tr>
                            <td style="width: 20%; font-weight: bold;">Idade:</td>
                            <td style="width: 80%;">{{ $adulto->idade }}</td>
                        </tr>
                        <tr>
                            <td style="width: 20%; font-weight: bold;">Perfil:</td>
                            <td style="width: 80%;">{{ $perfis[$adulto->perfil] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 20%; font-weight: bold;">Contato:</td>
                            <td style="width: 80%;">{{ $adulto->contato }}</td>
                        </tr>
                        <tr>
                            <td style="width: 20%; font-weight: bold;">Instagram:</td>
                            <td style="width: 80%;">{{ $adulto->instagram }}</td>
                        </tr>                        
                        <tr>
                            <td style="width: 20%; font-weight: bold;">Inscrição:</td>
                            <td style="width: 80%;">{{ formatDateTime($adulto->created_at) }}</td>
                        </tr>
                    </table>
                </td>
                <td style="width:20%; text-align:center;">
                    @if($adulto->foto && Storage::disk('public')->exists($adulto->foto))
                        <img src="{{ public_path('storage/' . $adulto->foto) }}" class="foto">
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
                <td style="width: 50%;">{{ $adulto->endereco_rua }}</td>
                <td style="width: 10%; font-weight: bold;">Número:</td>
                <td style="width: 30%;">{{ $adulto->endereco_numero }}</td>                
            </tr>
            <tr>                
                <td style="width: 10%; font-weight: bold;">Bairro:</td>
                <td style="width: 50%;">{{ $adulto->endereco_bairro }}</td>
                <td style="width: 10%; font-weight: bold;">Cidade:</td>
                <td style="width: 30%;">{{ $adulto->endereco_cidade }}</td> 
            </tr>
            <tr>
                <td style="width: 10%; font-weight: bold;">Estado:</td>
                <td style="width: 50%;">{{ $adulto->endereco_estado }}</td>
                <td style="width: 10%; font-weight: bold;">CEP:</td>
                <td style="width: 30%;">{{ $adulto->endereco_cep }}</td>              
            </tr>  
            <tr> 
                <td style="width: 10%; font-weight: bold;">Complemento:</td>
                <td colspan="3">{{ $adulto->endereco_complemento }}</td>              
            </tr>            
        </table>

    {{-- IGREJA E MOVIMENTOS --}}
    <div class="section-title">IGREJA E MOVIMENTOS</div>
        <table width="100%">
            <tr>
                <td style="width: 37%; font-weight: bold;">Frequenta a Paróquia ?</td>
                <td style="width: 63%;">
                    {{ $simNao[$adulto->frequenta_paroquia] }}

                    @if($adulto->frequenta_paroquia == 2)
                        , {{ $adulto->qual_paroquia }}
                    @endif                
                </td>                
            </tr>           
            <tr>
                <td style="width: 37%; font-weight: bold;">Já participou do Expresso Franciscano ?</td>
                <td style="width: 63%;">
                    {{ $simNao[$adulto->participou_expresso] }} 
                    
                    @if($adulto->participou_expresso == 1)
                        , {{ $adulto->ano_participacao }} 
                    @endif
                </td>                
            </tr>          
            <tr>
                <td style="width: 37%; font-weight: bold;">Já serviu no Expresso Franciscano ?</td>
                <td style="width: 63%;">
                    {{ $simNao[$adulto->serviu_expresso] }} 
                    
                    @if($adulto->serviu_expresso == 1)
                        , {{ $adulto->experiencias_servico }} 
                    @endif
                </td>                
            </tr>     
            <tr>
                <td style="width: 37%; font-weight: bold;">Vagões (equipes) que se identifica:</td>
                <td style="width: 63%;">
                    {{ $equipes[$adulto->vagao_1] }} 
                    
                    @if($adulto->vagao_2)
                        , {{ $equipes[$adulto->vagao_2] }} 
                    @endif
                    @if($adulto->vagao_3)
                        , {{ $equipes[$adulto->vagao_3] }} 
                    @endif
                </td>                
            </tr>      
            <tr>
                <td style="width: 37%; font-weight: bold;">Participa de Pastoral ou Comunidade ?</td>
                <td style="width: 63%;">
                    {{ $simNao[$adulto->participa_pastoral] }} 
                    
                    @if($adulto->participa_pastoral == 1)
                        , {{ $adulto->qual_pastoral }} 
                    @endif
                </td>                
            </tr> 
            <tr>
                <td style="width: 37%; font-weight: bold;">Já serviu no EJC/ECC ?</td>
                <td style="width: 63%;">
                    {{ $simNao[$adulto->serviu_ejc_ecc] }}
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
