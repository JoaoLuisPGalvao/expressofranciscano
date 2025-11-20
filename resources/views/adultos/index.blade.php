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
                    <x-btn-gerar-csv href="{!! route('adolecentes.gerarCsv', ['ano' => request()->get('ano'), 'status' => request()->get('status')]) !!}" title="Gerar Excel"></x-btn-gerar-csv>                    
                </div>
            </div>
        </x-slot>

        <x-slot name="body">
            <x-table>
                <x-slot name="thead">                   
                    <tr>
                        <th style="width: 15%">STATUS</th>
                        <th style="width: 40%">NOME</th>
                        <th style="width: 10%">DATA NASC</th>
                        <th style="width: 10%">GENERO</th>
                        <th style="width: 15%">INSCRIÇÃO</th>                                             
                        <th style="width: 10%">AÇÕES</th>
                    </tr>                
                </x-slot> 
                @foreach($adolecentes as $adolecente)                        
                <tr>
                    <td class="text-center">
                        <span class="badge {{ $statusClasses[$adolecente->status] ?? 'bg-secondary' }}" style="font-size: 0.7rem;">
                            {{ $listaStatus[$adolecente->status] ?? 'Desconhecido' }}
                        </span>
                    </td>
                    <td>{{ $adolecente->nome }}</td>                         
                    <td>{{ formatDate($adolecente->data_nasc) }}</td>                    
                    <td>{{ $generos[$adolecente->genero] }}</td>                    
                    <td>{{ formatDateTime($adolecente->created_at) }}</td>                                     

                    <td class="py-1">
                        <div class="d-flex align-items-center gap-2">
                            <x-btn-a-generico href="{{ route('adolecentes.aprovar', $adolecente) }}" icone="fas fa-thumbs-up" classe="btn-outline-success btn-sm {{ $adolecente->status == \App\Enums\StatusInscricao::VISUALIZADO ? '' : 'disabled' }}" title="Aprovar inscrição"></x-btn-a-generico>
                            <x-dropdown-acao        
                                :item-id="$adolecente->id" 
                                :ficha-route="route('adolecentes.ficha', $adolecente)" ficha-label="Ficha de inscrição"        
                                :edit-route="route('adolecentes.edit', $adolecente)"
                                :delete-route="route('adolecentes.destroy', $adolecente)" >
                            </x-dropdown-acao>
                        </div>
                    </td>
                </tr>  
                @endforeach 
            </x-table>
        </x-slot>
    </x-card>     
</div>

@endsection