@extends('layouts.main')

@section('title', 'Editar Encontrista')

@section('content')

<form action="{{ route('encontristas.update', ['encontrista' => $encontrista]) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
   <x-card size="col-12 col-lg-11 col-xxl-8">
      <x-slot name="header">
         <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-bold">Editando: {{ Str::limit($encontrista->nome, 30) }}</h4>
            <x-btn-retornar href="{{ route('encontristas.index') }}" title="Retornar"></x-btn-retornar>
         </div>
      </x-slot>

      <x-slot name="body">
         <div class="row">
            <div class="col-12 col-md-5">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="nome" name="nome" value="{{ $encontrista->nome }}" placeholder="Nome" required>
                  <label for="nome">* Nome</label>
               </div>
            </div>
            <div class="col-12 col-md-2">
               <div class="form-floating mb-2">
                  <input type="date" class="form-control" id="data_nasc" name="data_nasc" value="{{ $encontrista->data_nasc }}" placeholder="Data Nascimento" required>
                  <label for="data_nasc">* Data Nascimento</label>
               </div>
            </div>
            <div class="col-12 col-md-3">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control maskCpf" id="cpf" name="cpf" value="{{ $encontrista->cpf }}" placeholder="CPF" required>
                  <label for="cpf">* CPF</label>
               </div>
            </div>         
            <div class="col-12 col-md-2">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control" id="ano_expresso" name="ano_expresso" value="{{ $encontrista->ano_expresso }}" placeholder="ano_expresso" required>
                  <label for="ano_expresso">* Ano</label>
               </div>
            </div>        
         </div>

         <div class="row">
            <div class="col-12 col-md-3">
               <div class="form-floating mb-2">
                  <select class="form-select" id="genero" name="genero" required>                     
                     @foreach($generos as $key => $genero)                     
                     <option value="{{ $key }}" {{ $encontrista->genero == $key ? 'selected' : '' }}>{{ $key }} - {{ $genero }}</option>                     
                     @endforeach
                  </select>
                  <label for="genero">* Genero</label>
               </div>
            </div>    
            <div class="col-12 col-md-3">
               <div class="form-floating mb-2">
                  <select class="form-select" id="pais_casados" name="pais_casados" required>                     
                     @foreach($simNao as $key => $dado)                     
                     <option value="{{ $key }}" {{ $encontrista->pais_casados == $key ? 'selected' : '' }}>{{ $key }} - {{ $dado }}</option>                     
                     @endforeach
                  </select>
                  <label for="pais_casados">* Pais casados?</label>
               </div>
            </div>  
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                  <input type="file" class="form-control" id="foto" name="foto" placeholder="Foto" accept=".png, .jpg, .jpeg">
                  <label for="foto"><i class="fas fa-paperclip me-1"></i> Foto</label>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-12 col-md-8">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="pai_nome" name="pai_nome" value="{{ $encontrista->pai_nome }}" placeholder="Pai">
                  <label for="pai_nome">Pai</label>
               </div>
            </div>
            <div class="col-12 col-md-4">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control maskContato" id="pai_contato" name="pai_contato" value="{{ $encontrista->pai_contato }}" placeholder="Contato do Pai">
                  <label for="pai_contato">Contato do Pai</label>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-12 col-md-8">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="mae_nome" name="mae_nome" value="{{ $encontrista->mae_nome }}" placeholder="Mãe" required>
                  <label for="mae_nome">* Mãe</label>
               </div>
            </div>
            <div class="col-12 col-md-4">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control maskContato" id="mae_contato" name="mae_contato" value="{{ $encontrista->mae_contato }}" placeholder="Contato da mae" required>
                  <label for="mae_contato">* Contato da Mãe</label>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-12 col-md-3">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control maskCep" id="endereco_cep" name="endereco_cep" value="{{ $encontrista->endereco_cep }}" placeholder="CEP" required>
                  <label for="endereco_cep">* CEP</label>
               </div>
            </div>
            <div class="col-12 col-md-7">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control" id="endereco_rua" name="endereco_rua" value="{{ $encontrista->endereco_rua }}" placeholder="Rua" required>
                  <label for="endereco_rua">* Rua</label>
               </div>
            </div>
            <div class="col-12 col-md-2">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control" id="endereco_numero" name="endereco_numero" value="{{ $encontrista->endereco_numero }}" placeholder="Número" required>
                  <label for="endereco_numero">* Nr</label>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-12 col-md-4">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control" id="endereco_bairro" name="endereco_bairro" value="{{ $encontrista->endereco_bairro }}" placeholder="Bairro" required>
                  <label for="endereco_bairro">* Bairro</label>
               </div>
            </div>
            <div class="col-12 col-md-4">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control" id="endereco_cidade" name="endereco_cidade" value="{{ $encontrista->endereco_cidade }}" placeholder="Cidade" required>
                  <label for="endereco_cidade">* Cidade</label>
               </div>
            </div>
            <div class="col-12 col-md-4">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control" id="endereco_estado" name="endereco_estado" value="{{ $encontrista->endereco_estado }}" placeholder="Estado" required>
                  <label for="endereco_estado">* Estado</label>
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