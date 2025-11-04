@extends('layouts.main')

@section('title', 'Fraternidades')

@section('content')

<div class="row-fluid">	    
    <x-card size="col-12 col-lg-8 col-xxl-6">
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold">Fraternidades</h4>
                <div class="d-flex gap-2">   
                    <form class="d-flex align-items-center" method="GET" action="">
                        <input type="number" min="2024" class="form-control form-control-sm me-2 text-center" name="ano" value="{{ $ano }}">
                        <select name="fraternidade" class="form-select form-select-sm me-2" required>
                            <option value="">Selecione uma opção...</option>
                            @foreach($fraternidades as $key => $nome)
                            <option value="{{ $key }}" {{ $fraternidade == $key ? 'selected' : '' }}>{{ $nome }}</option>
                            @endforeach
                        </select>
                        <x-btn-pesquisar title="Pesquisar"></x-btn-pesquisar>   
                    </form> 
                    <x-btn-gerar-pdf href="{!! route('fraternidades.gerarPdf', ['ano' => request()->get('ano'), 'fraternidade' => request()->get('fraternidade')]) !!}" title="Relatório da fraternidade"></x-btn-gerar-pdf>
                </div>
            </div>
        </x-slot>

        <x-slot name="body">
            <x-table>
                <x-slot name="thead">                   
                    <tr>
                        <th style="width: 60%">NOME</th>
                        <th style="width: 35%">DATA NASC</th>   
                        <th style="width: 5%">AÇÕES</th>
                    </tr>                
                </x-slot> 
                @foreach($encontristas as $encontrista)                        
                <tr>
                    <td>{{ $encontrista->nome }}</td>                         
                    <td>{{ formatDate($encontrista->data_nasc) }}</td> 
                    <td class="py-1">
                        <x-dropdown-acao        
                            :item-id="$encontrista->id"        
                            :edit-route="route('fraternidades.edit', $encontrista)">
                        </x-dropdown-acao>
                    </td>
                </tr>  
                @endforeach 
            </x-table>
        </x-slot>
    </x-card>     
</div>

@endsection