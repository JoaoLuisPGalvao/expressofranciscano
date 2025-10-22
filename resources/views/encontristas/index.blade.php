@extends('layouts.main')

@section('title', 'Encontristas')

@section('content')

<div class="row-fluid">	    
    <x-card size="col-12 col-xxl-10">
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold">Encontristas</h4>
                <div class="d-flex gap-2">                    
                    <x-btn-cadastrar href="{{ route('encontristas.create') }}" title="Cadastrar novo econtrista"></x-btn-cadastrar>
                </div>
            </div>
        </x-slot>

        <x-slot name="body">
            <x-table>
                <x-slot name="thead">                   
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 25%">NOME</th>
                        <th style="width: 25%">E-MAIL</th>                    
                        <th style="width: 15%">NÍVEL</th>
                        <th style="width: 15%">EQUIPE</th>
                        <th style="width: 10%">STATUS</th>                        
                        <th style="width: 5%">AÇÕES</th>
                    </tr>                
                </x-slot>
                
                                                                
            </x-table>
        </x-slot>
    </x-card>     
</div>

@endsection