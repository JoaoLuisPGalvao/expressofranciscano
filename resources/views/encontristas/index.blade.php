@extends('layouts.main')

@section('title', 'Encontristas')

@section('content')

<div class="row-fluid">	    
    <x-card size="col-12 col-lg-11 col-xxl-10">
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold">Encontristas</h4>
                <div class="d-flex gap-2">   
                    <form class="d-flex align-items-center" method="GET" action="">
                        <input type="number" min="2024" class="form-control form-control-sm me-2 text-center" name="ano" value="{{ $ano }}">
                        <x-btn-pesquisar title="Pesquisar"></x-btn-pesquisar>   
                    </form>                                      
                    <x-btn-cadastrar href="{{ route('encontristas.create') }}" title="Cadastrar novo econtrista"></x-btn-cadastrar>
                </div>
            </div>
        </x-slot>

        <x-slot name="body">
            <x-table>
                <x-slot name="thead">                   
                    <tr>teste
                        <th style="width: 25%">NOME</th>
                        <th style="width: 9%">DATA NASC</th>                    
                        <th style="width: 9%">CPF</th>                    
                        <th style="width: 5%">GENERO</th>
                        <th style="width: 24%">MÃE</th>                                             
                        <th style="width: 23%">PAI</th>                                             
                        <th style="width: 5%">AÇÕES</th>
                    </tr>                
                </x-slot> 
                @foreach($encontristas as $encontrista)                        
                <tr>
                    <td>{{ $encontrista->nome }}</td>                         
                    <td>{{ formatDate($encontrista->data_nasc) }}</td>
                    <td>{{ $encontrista->cpf }}</td>
                    <td>{{ $generos[$encontrista->genero] }}</td>
                    <td>{{ $encontrista->mae_nome }}</td> 
                    <td>{{ $encontrista->pai_nome }}</td>                                     

                    <td class="py-1">
                        <x-dropdown-acao           
                            :ficha-route="route('encontristas.ficha', $encontrista)"                                         
                            :edit-route="route('encontristas.edit', $encontrista)"
                            :delete-route="route('encontristas.destroy', $encontrista)" >
                        </x-dropdown-acao>
                    </td>
                </tr>  
                @endforeach 
            </x-table>
        </x-slot>
    </x-card>     
</div>

@endsection