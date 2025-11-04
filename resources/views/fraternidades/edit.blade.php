@extends('layouts.main')

@section('title', 'Editar Fraternidade')

@section('content')

<form action="{{ route('fraternidades.update', ['encontrista' => $encontrista]) }}" method="POST">
@csrf
@method('PUT')
   <x-card size="col-12 col-md-8 col-xl-6 col-xxl-5">
      <x-slot name="header">
         <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-bold">Editando: {{ Str::limit($encontrista->nome, 25) }}</h4>
            <x-btn-retornar href="{{ route('fraternidades.index') }}" title="Retornar"></x-btn-retornar>
         </div>
      </x-slot>

      <x-slot name="body">
         <div class="row">
            <div class="col-12 col-md-7">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="nome" name="nome" value="{{ $encontrista->nome }}" placeholder="Nome" required>
                  <label for="nome">* Nome</label>
               </div>
            </div>            
            <div class="col-12 col-md-5">
               <div class="form-floating mb-2">
                  <select class="form-select" id="fraternidade" name="fraternidade" required>                     
                     @foreach($fraternidades as $key => $fraternidade)                     
                     <option value="{{ $key }}" {{ $encontrista->fraternidade == $key ? 'selected' : '' }}>{{ $key }} - {{ $fraternidade }}</option>                     
                     @endforeach
                  </select>
                  <label for="fraternidade">* Fraternidade</label>
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