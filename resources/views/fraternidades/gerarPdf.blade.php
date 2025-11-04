@extends('layouts.relatorio')

@section('title', 'Relatório por Fraternidade')

@section('content')    

    {{-- CABEÇALHO --}}
    <table class="header" width="100%">
        <tr>
            <td style="width: 100px; text-align: left;">
                <img src="{{ public_path('/img/logo_paroquia.png') }}" alt="Logo" class="logo">
            </td>
            <td style="text-align: center; padding-top: 15px;">
                <h3>PARÓQUIA SÃO FRANCISCO DE ASSIS</h3>
                <h3>Fraternidade {{ $nomeFraternidade }}</h3>
            </td>
            <td style="width: 100px; text-align: left;">
                <img src="{{ public_path('/img/logo_expresso.jpg') }}" alt="Logo" class="logo">
            </td>
        </tr>
    </table>

    @if($encontristas->isNotEmpty())
        <table class="table table-sm text-center">
            <thead>
                <tr style="background-color: #ABD5BD;">
                    <th style="width: 10%; border: 1px solid #808080;">NR ORD</th>
                    <th style="width: 60%; border: 1px solid #808080;">NOME</th>                                    
                    <th style="width: 30%; border: 1px solid #808080;">DATA NASCIMENTO</th>                                   
                </tr>
            </thead>
            <tbody>
                @foreach($encontristas as $encontrista)
                    <tr>
                        <td style="border: 1px solid #808080; border-top: none">
                            {{ $loop->iteration }}
                        </td>
                        <td style="border: 1px solid #808080; border-top: none">
                            {{ $encontrista->nome }}
                        </td> 
                        <td style="border: 1px solid #808080; border-top: none">
                            {{ formatDate($encontrista->data_nasc) }}                         
                        </td>
                    </tr>  
                @endforeach
            </tbody>     
        </table>    
    @else
        <p style="text-align:center; margin-top: 20px;"><strong>Nenhum registro encontrado para esta fraternidade.</strong></p>
    @endif
@endsection

{{-- RODAPÉ --}}
@section('footer')
    <table width="100%">
        <tr>
            <td style="text-align: left; font-size:10px; line-height:1.4;">
                <em>“Paz e Bem!”</em><br>
            </td>
            <td style="text-align: right; font-size:10px; vertical-align: bottom;">
                Página <span class="page-number"></span><span class="page-total"></span>
            </td>
        </tr>
    </table>
@endsection
