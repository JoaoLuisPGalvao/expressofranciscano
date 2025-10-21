@extends('layouts.main')

@section('title', 'Cadastrar Usuário')

@section('content')

<form action="{{ route('users.store') }}" method="POST">
@csrf
   <x-card size="col-12 col-lg-8 col-xl-6">
      <x-slot name="header">
         <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-bold">Cadastrar Usuário</h4>
            <x-btn-retornar href="{{ route('users.index') }}" title="Retornar"></x-btn-retornar>
         </div>
      </x-slot>
       
      <x-slot name="body">         
         <div class="row">
            <div class="col-12 col-md-8">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="name" name="name" value="{{ old('name') }}" placeholder="Nome" required>
                  <label for="name">* Nome</label>
               </div>
            </div>
            <div class="col-12 col-md-4">
               <div class="form-floating mb-2">
                  <select class="form-select" id="nivel" name="nivel" required>
                     <option value="">Selecione um nível...</option>
                     @foreach($nivel as $key => $nivelDesc)
                     @if(auth()->user()->nivel == 1 || $key != 1) 
                        <option value="{{ $key }}" {{ old('nivel') == $key ? 'selected' : '' }}>{{ $key }} - {{ $nivelDesc }}</option>
                     @endif
                     @endforeach
                  </select>
                  <label for="nivel">* Nível</label>
               </div>
            </div> 
         </div>

         <div class="row">            
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                  <input type="email" class="form-control text-lowercase" id="email" name="email" value="{{ old('email') }}" placeholder="Digite o e-mail" required>
                  <label for="email">* E-mail</label>                  
               </div>
            </div>  
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                  <select class="form-select" id="equipe" name="equipe" required>
                     <option value="">Selecione uma equipe...</option>
                     @foreach($equipes as $key => $equipe)                     
                     <option value="{{ $key }}" {{ old('equipe') == $key ? 'selected' : '' }}>{{ $key }} - {{ $equipe }}</option>                     
                     @endforeach
                  </select>
                  <label for="equipe">* Equipe</label>
               </div>
            </div>           
         </div>

         <div class="row">            
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Digite a senha" required>
                  <label for="password">* Senha</label>                  
               </div>
            </div>
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                  <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirme a senha" required>
                  <label for="password2">* Confirme a senha</label>                  
               </div>
            </div>
         </div>        
      </x-slot>

      <x-slot name="footer"> 
         <x-btn-cancelar title="Cancelar"></x-btn-cancelar> 
         <x-btn-salvar title="Salvar"></x-btn-salvar> 
      </x-slot>        
   </x-card>
</form>

@endsection