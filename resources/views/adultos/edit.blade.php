@extends('layouts.main')

@section('title', 'Editar Adulto')

@section('content')

<form action="{{ route('adultos.update', ['adulto' => $adulto]) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
   <x-card size="col-12 col-md-11 col-xl-10 col-xxl-9">
      <x-slot name="header">
         <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-bold">Editando: {{ Str::limit($adulto->nome, 30) }}</h4>
            <x-btn-retornar href="{{ route('adultos.index') }}" title="Retornar"></x-btn-retornar>
         </div>
      </x-slot>

      <x-slot name="body">         
            <div class="row">
               <div class="col-12 col-md-5">
                  <div class="form-floating mb-2">
                     <input type="text" class="form-control text-uppercase" id="nome" name="nome" value="{{ $adulto->nome }}" placeholder="Nome" required data-bs-toggle="tooltip" data-bs-title="Se for casal, preencher o nome do casal.">
                     <label for="nome">* Nome</label>                     
                  </div>
               </div>               
               <div class="col-12 col-md-3">
                  <div class="form-floating mb-2">
                     <select class="form-select" id="perfil" name="perfil" placeholder="Nome" required data-bs-toggle="tooltip" data-bs-title="OUTROS (viúvos, pais e mães solteiros, casais não sacramentados ou divorciados)">
                        @foreach($perfis as $key => $perfil)                     
                        <option value="{{ $key }}" {{ $adulto->perfil == $key ? 'selected' : '' }}>{{ $key }} - {{ $perfil }}</option>                     
                        @endforeach
                     </select>
                     <label for="perfil">* Perfil</label>                     
                  </div>
               </div>  
               <div class="col-12 col-md-2">
                  <div class="form-floating mb-2">
                     <input type="text" class="form-control" id="idade" name="idade" value="{{ $adulto->idade }}" placeholder="idade" required data-bs-toggle="tooltip" data-bs-title="Se for casal, informar a idade dos dois.">
                     <label for="idade">* Idade</label>                     
                  </div>
               </div>  
               <div class="col-12 col-md-2">
                  <div class="form-floating mb-2">
                     <input type="text" class="form-control" id="ano_expresso" name="ano_expresso" value="{{ $adulto->ano_expresso }}" placeholder="ano_expresso" readonly>
                     <label for="ano_expresso">* Ano</label>
                  </div>
               </div>                            
            </div>

            <div class="row">
               <div class="col-12 col-md-3">
                  <div class="form-floating mb-2">
                     <input type="text" class="form-control maskCep" id="endereco_cep" name="endereco_cep" value="{{ $adulto->endereco_cep }}" placeholder="CEP" required>
                     <label for="endereco_cep">* CEP</label>
                  </div>
               </div>
               <div class="col-12 col-md-7">
                  <div class="form-floating mb-2">
                     <input type="text" class="form-control text-uppercase" id="endereco_rua" name="endereco_rua" value="{{ $adulto->endereco_rua }}" placeholder="Rua" required>
                     <label for="endereco_rua">* Rua</label>
                  </div>
               </div>
               <div class="col-12 col-md-2">
                  <div class="form-floating mb-2">
                     <input type="text" class="form-control" id="endereco_numero" name="endereco_numero" value="{{ $adulto->endereco_numero }}" placeholder="Número" required>
                     <label for="endereco_numero">* Nr</label>
                  </div>
               </div>
            </div>
            
            <div class="row">
               <div class="col-12 col-md-3">
                  <div class="form-floating mb-2">
                     <input type="text" class="form-control text-uppercase" id="endereco_bairro" name="endereco_bairro" value="{{ $adulto->endereco_bairro }}" placeholder="Bairro" required>
                     <label for="endereco_bairro">* Bairro</label>
                  </div>
               </div>
               <div class="col-12 col-md-3">
                  <div class="form-floating mb-2">
                     <input type="text" class="form-control text-uppercase" id="endereco_cidade" name="endereco_cidade" value="{{ $adulto->endereco_cidade }}" placeholder="Cidade" required>
                     <label for="endereco_cidade">* Cidade</label>
                  </div>
               </div>
               <div class="col-12 col-md-2">
                  <div class="form-floating mb-2">
                     <input type="text" class="form-control text-uppercase" id="endereco_estado" name="endereco_estado" value="{{ $adulto->endereco_estado }}" placeholder="Estado" required maxlength="2" pattern="[A-Z]{2}" title="Informe apenas a sigla do estado, por exemplo: PB, SP, RJ.">
                     <label for="endereco_estado">* Estado</label>
                  </div>
               </div>
               <div class="col-12 col-md-4">
                  <div class="form-floating mb-2">
                     <input type="text" class="form-control" id="endereco_complemento" name="endereco_complemento" value="{{ $adulto->endereco_complemento }}" placeholder="complemento">
                     <label for="endereco_complemento">Complemento</label>
                  </div>
               </div>
            </div> 

            <div class="row">               
               <div class="col-12 col-md-5">
                  <div class="form-floating mb-2">
                     <input type="text" class="form-control maskContato" id="contato" name="contato" value="{{ $adulto->contato }}" placeholder="Contato" required data-bs-toggle="tooltip" data-bs-title="Se for casal, informar os dois números de celular.">
                     <label for="contato">* Contato (WHATSAPP)</label>
                  </div>
               </div>
               <div class="col-12 col-md-7">
                  <div class="form-floating mb-2">
                     <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $adulto->instagram }}" placeholder="Instagram" data-bs-toggle="tooltip" data-bs-title="Se for casal, informar os dois perfis.">
                     <label for="instagram">Instagram</label>
                  </div>
               </div>
            </div>

            <div class="row">    
               <div class="col-12 col-md-3">
                  <div class="form-floating mb-2">
                     <select class="form-select" id="frequenta_paroquia" name="frequenta_paroquia" required>
                        @foreach($simNao as $key => $dado)                     
                        <option value="{{ $key }}" {{ $adulto->frequenta_paroquia == $key ? 'selected' : '' }}>{{ $key }} - {{ $dado }}</option>                     
                        @endforeach
                     </select>
                     <label for="frequenta_paroquia">
                        * Frequenta a Paróquia ?
                     </label>
                  </div>
               </div>               
               <div class="col-12 col-md-3">
                  <div class="form-floating mb-2">
                     <input type="text" class="form-control text-uppercase" id="qual_paroquia" name="qual_paroquia" value="{{ $adulto->qual_paroquia }}" placeholder="Se NÃO, de qual Paróquia você é ?" disabled>
                     <label for="qual_paroquia">Qual a sua Paróquia ?</label>
                  </div>
               </div>
               <div class="col-12 col-md-3">
                  <div class="form-floating mb-2">
                     <select class="form-select" id="participou_expresso" name="participou_expresso" required>
                        @foreach($simNao as $key => $dado)                     
                        <option value="{{ $key }}" {{ $adulto->participou_expresso == $key ? 'selected' : '' }}>{{ $key }} - {{ $dado }}</option>                     
                        @endforeach
                     </select>
                     <label for="participou_expresso">
                        * Já pasticipou do expresso ?
                     </label>
                  </div>
               </div>
               <div class="col-12 col-md-3">
                  <div class="form-floating mb-2">
                     <input type="number" class="form-control" min="2019" id="ano_participacao" name="ano_participacao" value="{{ $adulto->ano_participacao }}" placeholder="Em que ano ?" disabled>
                     <label for="ano_participacao">Em que ano ?</label>
                  </div>
               </div>
            </div>  

            <div class="row">    
               <div class="col-12 col-md-3">
                  <div class="form-floating mb-2">
                     <select class="form-select" id="serviu_expresso" name="serviu_expresso" required>
                        @foreach($simNao as $key => $dado)                     
                        <option value="{{ $key }}" {{ $adulto->serviu_expresso == $key ? 'selected' : '' }}>{{ $key }} - {{ $dado }}</option>                     
                        @endforeach
                     </select>
                     <label for="serviu_expresso">
                        * Já serviu no Expresso Franciscano ?
                     </label>
                  </div>
               </div>
               <div class="col-12 col-md-9">
                  <div class="form-floating mb-2">
                     <input type="text" class="form-control text-uppercase" id="experiencias_servico" name="experiencias_servico" value="{{ $adulto->experiencias_servico }}" placeholder="Se NÃO, de qual Paróquia você é ?" disabled>
                     <label for="experiencias_servico">Descreva, brevemente, suas experiências.</label>
                  </div>
               </div>               
            </div> 

            <div class="row">
               <div class="col-12">
                  <label class="form-label fw-semibold mb-1 ms-2">
                     Selecione até três vagões (equipes) que você se identifica:
                  </label>
               </div>
            </div>

            <div class="row">    
               <div class="col-12 col-md-4">
                  <div class="form-floating mb-2">
                     <select class="form-select" id="vagao_1" name="vagao_1" required>
                        @foreach($equipes as $key => $equipe)                     
                        <option value="{{ $key }}" {{ $adulto->vagao_1 == $key ? 'selected' : '' }}>{{ $key }} - {{ $equipe }}</option>                     
                        @endforeach
                     </select>
                     <label for="vagao_1">
                        * Vagão 01 ?
                     </label>
                  </div>
               </div>     
               <div class="col-12 col-md-4">
                  <div class="form-floating mb-2">
                     <select class="form-select" id="vagao_2" name="vagao_2">
                        @foreach($equipes as $key => $equipe)                     
                        <option value="{{ $key }}" {{ $adulto->vagao_2 == $key ? 'selected' : '' }}>{{ $key }} - {{ $equipe }}</option>                     
                        @endforeach
                     </select>
                     <label for="vagao_2">
                        Vagão 02 ?
                     </label>
                  </div>
               </div>      
               <div class="col-12 col-md-4">
                  <div class="form-floating mb-2">
                     <select class="form-select" id="vagao_3" name="vagao_3">
                        @foreach($equipes as $key => $equipe)                     
                        <option value="{{ $key }}" {{ $adulto->vagao_3 == $key ? 'selected' : '' }}>{{ $key }} - {{ $equipe }}</option>                     
                        @endforeach
                     </select>
                     <label for="vagao_3">
                        Vagão 03 ?
                     </label>
                  </div>
               </div>                         
            </div> 
            
            <div class="row">    
               <div class="col-12 col-md-4">
                  <div class="form-floating mb-2">
                     <select class="form-select" id="participa_pastoral" name="participa_pastoral" required>
                        @foreach($simNao as $key => $dado)                     
                        <option value="{{ $key }}" {{ $adulto->participa_pastoral == $key ? 'selected' : '' }}>{{ $key }} - {{ $dado }}</option>                     
                        @endforeach
                     </select>
                     <label for="participa_pastoral">
                        * Participa de Pastoral ou Comunidade ?
                     </label>
                  </div>
               </div>
               <div class="col-12 col-md-8">
                  <div class="form-floating mb-2">
                     <input type="text" class="form-control text-uppercase" id="qual_pastoral" name="qual_pastoral" value="{{ $adulto->qual_pastoral }}" placeholder="Se NÃO, de qual Paróquia você é ?" disabled>
                     <label for="qual_pastoral">Qual ?</label>
                  </div>
               </div>               
            </div>             

            <div class="row"> 
               <div class="col-12 col-md-4">
                  <div class="form-floating mb-2">
                     <select class="form-select" id="serviu_ejc_ecc" name="serviu_ejc_ecc" required>
                        @foreach($simNao as $key => $dado)                     
                        <option value="{{ $key }}" {{ $adulto->serviu_ejc_ecc == $key ? 'selected' : '' }}>{{ $key }} - {{ $dado }}</option>                     
                        @endforeach
                     </select>
                     <label for="serviu_ejc_ecc">
                        * Já serviu no EJC/ECC ?
                     </label>
                  </div>
               </div>               
               <div class="col-12 col-md-8">
                  <div class="form-floating mb-2">
                     <input type="file" class="form-control" id="foto" name="foto" placeholder="Foto" accept=".png, .jpg, .jpeg" data-bs-toggle="tooltip" data-bs-title="Se for casal, coloque a foto do casal.">
                     <label for="foto"><i class="fas fa-paperclip me-1"></i> Foto, se for casal, coloque a foto do casal.</label>
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