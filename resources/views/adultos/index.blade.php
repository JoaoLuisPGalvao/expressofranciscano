@extends('layouts.main')

@section('title', 'Adultos')

@section('content')

<div class="row-fluid">	    
    <x-card size="col-12 col-lg-11 col-xxl-10">
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold">Adultos - Inscrições</h4>
                <div class="d-flex gap-2">   
                    <form class="d-flex align-items-center" method="GET" action="">
                        <input type="number" min="2024" class="form-control form-control-sm me-2 text-center" name="ano" value="{{ $ano }}">
                        <select name="status" class="form-select form-select-sm me-2">
                            <option value="">Status...</option>
                            @foreach($listaStatus as $key => $nome)
                            <option value="{{ $key }}" {{ $status == $key ? 'selected' : '' }}>{{ $key }} - {{ $nome }}</option>
                            @endforeach
                        </select>
                        <x-btn-pesquisar title="Pesquisar"></x-btn-pesquisar>   
                    </form>
                    <x-btn-gerar-csv href="{!! route('adultos.gerarCsv', ['ano' => request()->get('ano'), 'status' => request()->get('status')]) !!}" title="Gerar Excel"></x-btn-gerar-csv>                    
                </div>
            </div>
        </x-slot>

        <x-slot name="body">
            <x-table>
                <x-slot name="thead">                   
                    <tr>
                        <th style="width: 10%">STATUS</th>
                        <th style="width: 30%">NOME</th>
                        <th style="width: 10%">PERFIL</th>
                        <th style="width: 15%">CONTATO</th>
                        <th style="width: 15%">INSTAGRAM</th>
                        <th style="width: 15%">INSCRIÇÃO</th>                                             
                        <th style="width: 5%">AÇÕES</th>
                    </tr>                
                </x-slot> 
                @foreach($adultos as $adulto)                        
                <tr>
                    <td class="text-center">
                        <span class="badge {{ $statusClasses[$adulto->status] ?? 'bg-secondary' }}" style="font-size: 0.7rem;">
                            {{ $listaStatus[$adulto->status] ?? 'Desconhecido' }}
                        </span>
                    </td>
                    <td>{{ $adulto->nome }}</td>                         
                    <td>{{ $perfis[$adulto->perfil] }}</td>                    
                    <td>{{ $adulto->contato ?? '' }}</td>                    
                    <td>{{ $adulto->instagram ?? '' }}</td>                    
                    <td>{{ formatDateTime($adulto->created_at) }}</td>
                    <td class="py-1">                                         
                        <x-dropdown-acao        
                            :item-id="$adulto->id" 
                            :ficha-route="route('adultos.ficha', $adulto)" ficha-label="Ficha de inscrição"        
                            :aprovar-route="route('adultos.aprovar', $adulto)" aprovar-label="Aprovar Inscrição"
                            :aprovar-disabled="$adulto->status <> '2'"      
                            :delete-route="route('adultos.destroy', $adulto)" >
                        </x-dropdown-acao>                        
                    </td>
                </tr>  
                @endforeach 
            </x-table>
        </x-slot>
    </x-card>     
</div>

@endsection