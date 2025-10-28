@extends('layouts.main')

@section('title', 'Usuários')

@section('content')

<div class="row-fluid">	    
    <x-card size="col-12 col-xxl-10">
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold">Usuários</h4>
                <div class="d-flex gap-2">                    
                    <x-btn-cadastrar href="{{ route('users.create') }}" title="Cadastrar novo usuário"></x-btn-cadastrar>
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
                
                @foreach($users as $user)                        
                <tr>
                    <td class="fw-bold">{{ $user->id }}</td> 
                    <td>{{ $user->name }}</td>                         
                    <td>{{ $user->email }}</td>
                    <td>{{ $nivel[$user->nivel] }}</td>
                    <td>{{ $equipes[$user->equipe] }}</td>
                    <td><span class="badge text-bg-{{ $user->status == 1 ? 'success' : 'danger' }}">{{ $ativoInativo[$user->status] }}</span> </td>                    
                    <td class="py-1">
                        <x-dropdown-acao   
                            :item-id="$user->id"                                                    
                            :edit-route="route('users.edit', $user)"
                            :delete-route="route('users.destroy', $user)" >
                        </x-dropdown-acao>
                    </td>
                </tr>  
                @endforeach                                                       
            </x-table>
        </x-slot>
    </x-card>     
</div>

@endsection