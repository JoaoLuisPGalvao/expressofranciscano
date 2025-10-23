@extends('layouts.main')

@section('title', 'Editar Usuário')

@section('content')

<form action="{{ route('users.update', ['user' => $user]) }}" method="POST">
@csrf
@method('PUT')
   <x-card size="col-12 col-lg-8 col-xl-6">
      <x-slot name="header">
         <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-bold">Editando: {{ Str::limit($user->name, 30) }}</h4>
            <x-btn-retornar href="{{ route('users.index') }}" title="Retornar"></x-btn-retornar>
         </div>
      </x-slot>

      <x-slot name="body">
         <div class="row">
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="name" name="name" value="{{ $user->name }}" placeholder="Nome" required>
                  <label for="name">* Nome</label>
               </div>
            </div>
            <div class="col-12 col-md-3">
               <div class="form-floating mb-2">
                  <select class="form-select" id="nivel" name="nivel" required>
                     @foreach ($nivel as $key => $nivel)
                        @if(auth()->user()->nivel == 1 || $key != 1)
                           <option value="{{ $key }}" {{ $user->nivel == $key ? 'selected' : '' }}>{{ $key }} - {{ $nivel }}</option>
                        @endif
                     @endforeach
                  </select>
                  <label for="nivel">* Nível</label>
               </div>
            </div>
            <div class="col-12 col-md-3">
               <div class="form-floating mb-2">
                  <select class="form-select" id="status" name="status" required>
                     @foreach ($ativoInativo as $key => $status)                        
                     <option value="{{ $key }}" {{ $user->status == $key ? 'selected' : '' }}>{{ $key }} - {{ $status }}</option>                        
                     @endforeach
                  </select>
                  <label for="nivel">* Nível</label>
               </div>
            </div>
         </div>

         <div class="row">            
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                  <input type="email" class="form-control text-lowercase" id="email" name="email" value="{{ $user->email }}" placeholder="Digite o e-mail" required>
                  <label for="email">* E-mail</label>                  
               </div>
            </div>
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                  <select class="form-select" id="equipe" name="equipe" required>
                     <option value="">Selecione uma equipe...</option>
                     @foreach($equipes as $key => $equipe)                     
                     <option value="{{ $key }}" {{ $user->equipe == $key ? 'selected' : '' }}>{{ $key }} - {{ $equipe }}</option>                     
                     @endforeach
                  </select>
                  <label for="equipe">* Equipe</label>
               </div>
            </div> 
         </div>  
      </x-slot>

      <x-slot name="footer">
         <x-btn-cancelar title="Cancelar"></x-btn-cancelar>
         <x-btn-atualizar title="Atualizar"></x-btn-atualizar>
      </x-slot>
   </x-card>
</form>

@endsection