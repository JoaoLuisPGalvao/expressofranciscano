@extends('layouts.main')

@section('title', 'Adolecentes')

@section('content')

<div class="row-fluid">	    
    <x-card size="col-12 col-lg-11 col-xxl-10">
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold">Inscrições</h4>
                <div class="d-flex gap-2">   
                    <form class="d-flex align-items-center" method="GET" action="">
                        <input type="number" min="2024" class="form-control form-control-sm me-2 text-center" name="ano" value="{{ $ano }}">
                        <select name="status" class="form-select form-select-sm me-2">
                            <option value="">Status...</option>
                            @foreach($listaStatus as $key => $nome)
                            <option value="{{ $key }}" {{ $status == $key ? 'selected' : '' }}>{{ $nome }}</option>
                            @endforeach
                        </select>
                        <x-btn-pesquisar title="Pesquisar"></x-btn-pesquisar>   
                    </form>
                    <x-btn-gerar-csv href="{{ route('adolecentes.gerarCsv', ['ano' => request()->get('ano')]) }}" title="Gerar Excel"></x-btn-gerar-csv>                    
                </div>
            </div>
        </x-slot>

        <x-slot name="body">
            <x-table>
                <x-slot name="thead">                   
                    <tr>
                        <th style="width: 10%">STATUS</th>
                        <th style="width: 40%">NOME</th>
                        <th style="width: 10%">DATA NASC</th>
                        <th style="width: 10%">GENERO</th>
                        <th style="width: 10%">INSCRIÇÃO</th>                                             
                        <th style="width: 5%">AÇÕES</th>
                    </tr>                
                </x-slot> 
                @foreach($adolecentes as $adolecente)                        
                <tr>
                    <td class="text-center">
                        <span class="badge {{ $statusClasses[$adolecente->status] ?? 'bg-secondary' }}" style="font-size: 0.8rem;">
                            {{ $listaStatus[$adolecente->status] ?? 'Desconhecido' }}
                        </span>
                    </td>
                    <td>{{ $adolecente->nome }}</td>                         
                    <td>{{ formatDate($adolecente->data_nasc) }}</td>                    
                    <td>{{ $generos[$adolecente->genero] }}</td>                    
                    <td>{{ formatDateTime($adolecente->created_at) }}</td>                                     

                    <td class="py-1">
                        <x-dropdown-acao        
                            :item-id="$adolecente->id"          
                            :edit-route="route('adolecentes.edit', $adolecente)"
                            :delete-route="route('adolecentes.destroy', $adolecente)" >
                        </x-dropdown-acao>
                    </td>
                </tr>  
                @endforeach 
            </x-table>
        </x-slot>
    </x-card>     
</div>

@endsection