@extends('layouts.relatorioPdf')

@section('title', 'Ficha Cadastral')

@section('content') 
    @foreach ($encontristas as $encontrista)
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
        
        <table>
            <tr>
                <td colspan="2" style="width:80%">
                    <table style="width:100%">
                        <tr>
                            <td class="label">Nome:</td>
                            <td>{{ $encontrista->nome }}</td>
                        </tr>
                        <tr>
                            <td class="label">CPF:</td>
                            <td>{{ $encontrista->cpf }}</td>
                        </tr>
                        <tr>
                            <td class="label">Data de Nascimento:</td>
                            <td>{{ formatDate($encontrista->data_nasc) }}</td>
                        </tr>
                        <tr>
                            <td class="label">Gênero:</td>
                            <td>{{ $generos[$encontrista->genero] ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Ano Expresso:</td>
                            <td>{{ $encontrista->ano_expresso }}</td>
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

        <div class="section-title">INFORMAÇÕES DOS PAIS</div>
        <table>
            <tr>
                <td class="label">Nome do Pai:</td>
                <td>{{ $encontrista->pai_nome }}</td>
            </tr>
            <tr>
                <td class="label">Contato do Pai:</td>
                <td>{{ $encontrista->pai_contato }}</td>
            </tr>
            <tr>
                <td class="label">Nome da Mãe:</td>
                <td>{{ $encontrista->mae_nome }}</td>
            </tr>
            <tr>
                <td class="label">Contato da Mãe:</td>
                <td>{{ $encontrista->mae_contato }}</td>
            </tr>
            <tr>
                <td class="label">Pais Casados:</td>
                <td>{{ $simNao[$encontrista->pais_casados] ?? '' }}</td>
            </tr>
        </table>

        <div class="section-title">ENDEREÇO</div>
        <table>
            <tr>
                <td class="label">Rua:</td>
                <td>{{ $encontrista->endereco_rua }}</td>
            </tr>
            <tr>
                <td class="label">Número:</td>
                <td>{{ $encontrista->endereco_numero }}</td>
            </tr>
            <tr>
                <td class="label">Bairro:</td>
                <td>{{ $encontrista->endereco_bairro }}</td>
            </tr>
            <tr>
                <td class="label">Cidade:</td>
                <td>{{ $encontrista->endereco_cidade }}</td>
            </tr>
            <tr>
                <td class="label">Estado:</td>
                <td>{{ $encontrista->endereco_estado }}</td>
            </tr>
            <tr>
                <td class="label">CEP:</td>
                <td>{{ $encontrista->endereco_cep }}</td>
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
