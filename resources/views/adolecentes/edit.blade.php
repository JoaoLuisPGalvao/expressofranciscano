@extends('layouts.main')

@section('title', 'Editar Adolecente')

@section('content')

<form action="{{ route('adolecentes.update', ['adolecente' => $adolecente]) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
   <x-card size="col-12 col-md-11 col-xl-10 col-xxl-9">
      <x-slot name="header">
         <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-bold">Editando: {{ Str::limit($adolecente->nome, 30) }}</h4>
            <x-btn-retornar href="{{ route('adolecentes.index') }}" title="Retornar"></x-btn-retornar>
         </div>
      </x-slot>

      <x-slot name="body">
         <div class="row">
            <div class="col-12 col-md-5">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="nome" name="nome" value="{{ $adolecente->nome }}" placeholder="Nome" required>
                  <label for="nome">* Nome</label>
               </div>
            </div>
            <div class="col-12 col-md-2">
               <div class="form-floating mb-2">
                  <input type="date" class="form-control" id="data_nasc" name="data_nasc" value="{{ $adolecente->data_nasc }}" placeholder="Data Nascimento" required>
                  <label for="data_nasc">* Data Nascimento</label>
               </div>
            </div>
            <div class="col-12 col-md-3">
               <div class="form-floating mb-2">
                  <select class="form-select" id="genero" name="genero" required>                     
                     @foreach($generos as $key => $genero)                     
                     <option value="{{ $key }}" {{ $adolecente->genero == $key ? 'selected' : '' }}>{{ $key }} - {{ $genero }}</option>                     
                     @endforeach
                  </select>
                  <label for="genero">* Genero</label>
               </div>
            </div>                 
            <div class="col-12 col-md-2">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control" id="ano_expresso" name="ano_expresso" value="{{ $adolecente->ano_expresso }}" placeholder="ano_expresso" readonly>
                  <label for="ano_expresso">* Ano</label>
               </div>
            </div>        
         </div>

         <div class="row">
            <div class="col-12 col-md-3">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control maskCep" id="endereco_cep" name="endereco_cep" value="{{ $adolecente->endereco_cep }}" placeholder="CEP" required>
                  <label for="endereco_cep">* CEP</label>
               </div>
            </div>
            <div class="col-12 col-md-7">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="endereco_rua" name="endereco_rua" value="{{ $adolecente->endereco_rua }}" placeholder="Rua" required>
                  <label for="endereco_rua">* Rua</label>
               </div>
            </div>
            <div class="col-12 col-md-2">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control" id="endereco_numero" name="endereco_numero" value="{{ $adolecente->endereco_numero }}" placeholder="Número" required>
                  <label for="endereco_numero">* Nr</label>
               </div>
            </div>
         </div>
         
         <div class="row">
            <div class="col-12 col-md-3">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="endereco_bairro" name="endereco_bairro" value="{{ $adolecente->endereco_bairro }}" placeholder="Bairro" required>
                  <label for="endereco_bairro">* Bairro</label>
               </div>
            </div>
            <div class="col-12 col-md-3">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="endereco_cidade" name="endereco_cidade" value="{{ $adolecente->endereco_cidade }}" placeholder="Cidade" required>
                  <label for="endereco_cidade">* Cidade</label>
               </div>
            </div>
            <div class="col-12 col-md-2">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="endereco_estado" name="endereco_estado" value="{{ $adolecente->endereco_estado }}" placeholder="Estado" required maxlength="2" pattern="[A-Z]{2}" title="Informe apenas a sigla do estado, por exemplo: PB, SP, RJ.">
                  <label for="endereco_estado">* Estado</label>
               </div>
            </div>
            <div class="col-12 col-md-4">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="endereco_complemento" name="endereco_complemento" value="{{ $adolecente->endereco_complemento }}" placeholder="complemento">
                  <label for="endereco_complemento">Complemento</label>
               </div>
            </div>
         </div> 

         <div class="row">    
            <div class="col-12 col-md-2">
               <div class="form-floating mb-2">
                  <select class="form-select" id="estuda" name="estuda" required>                     
                     @foreach($simNao as $key => $dado)                     
                     <option value="{{ $key }}" {{ $adolecente->estuda == $key ? 'selected' : '' }}>{{ $key }} - {{ $dado }}</option>                     
                     @endforeach
                  </select>
                  <label for="estuda">* Estuda ?</label>
               </div>
            </div>          
            <div class="col-12 col-md-5">   
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="escola" name="escola" value="{{ $adolecente->escola }}" placeholder="escola" disabled>
                  <label for="escola">Escola</label>
               </div>                 
            </div>  
            <div class="col-12 col-md-3">
               <div class="form-floating mb-2">
                  <select class="form-select" id="serie" name="serie" disabled>                     
                     @foreach($series as $key => $dado)                     
                     <option value="{{ $key }}" {{ $adolecente->serie == $key ? 'selected' : '' }}>{{ $key }} - {{ $dado }}</option>                     
                     @endforeach
                  </select>
                  <label for="serie">Série</label>
               </div>               
            </div>
            <div class="col-12 col-md-2">
               <div class="form-floating mb-2">
                  <select class="form-select" id="turno" name="turno" disabled>                     
                     @foreach($turnos as $key => $dado)                     
                     <option value="{{ $key }}" {{ $adolecente->turno == $key ? 'selected' : '' }}>{{ $key }} - {{ $dado }}</option>                     
                     @endforeach
                  </select>
                  <label for="turno">Turno</label>
               </div>               
            </div>
         </div>

         <div class="row">    
            <div class="col-12 col-md-3">
               <div class="form-floating mb-2">
                  <select class="form-select" id="tem_irmaos" name="tem_irmaos" required>                     
                     @foreach($irmaos as $key => $dado)                     
                     <option value="{{ $key }}" {{ $adolecente->tem_irmaos == $key ? 'selected' : '' }}>{{ $key }} - {{ $dado }}</option>                     
                     @endforeach
                  </select>
                  <label for="tem_irmaos">* Tem Irmão(s)?</label>
               </div>
            </div>          
            <div class="col-12 col-md-3">
               <div class="form-floating mb-2">
                  <select class="form-select" id="pais_casados" name="pais_casados" required>                     
                     @foreach($simNao as $key => $dado)                     
                     <option value="{{ $key }}" {{ $adolecente->pais_casados == $key ? 'selected' : '' }}>{{ $key }} - {{ $dado }}</option>                     
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
                  <input type="text" class="form-control text-uppercase" id="pai_nome" name="pai_nome" value="{{ $adolecente->pai_nome }}" placeholder="Pai">
                  <label for="pai_nome">Pai</label>
               </div>
            </div>
            <div class="col-12 col-md-4">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control maskContato" id="pai_contato" name="pai_contato" value="{{ $adolecente->pai_contato }}" placeholder="Contato do Pai">
                  <label for="pai_contato">Contato do Pai</label>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-12 col-md-8">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="mae_nome" name="mae_nome" value="{{ $adolecente->mae_nome }}" placeholder="Mãe" required>
                  <label for="mae_nome">* Mãe</label>
               </div>
            </div>
            <div class="col-12 col-md-4">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control maskContato" id="mae_contato" name="mae_contato" value="{{ $adolecente->mae_contato }}" placeholder="Contato da mae" required>
                  <label for="mae_contato">* Contato da Mãe</label>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="outro_responsavel_nome" name="outro_responsavel_nome" value="{{ $adolecente->outro_responsavel_nome }}" placeholder="Pai">
                  <label for="outro_responsavel_nome">Outro responsável</label>
               </div>
            </div>
            <div class="col-12 col-md-4">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control maskContato" id="outro_responsavel_contato" name="outro_responsavel_contato" value="{{ $adolecente->outro_responsavel_contato }}" placeholder="Contato do Pai">
                  <label for="outro_responsavel_contato">Contato do Responsável</label>
               </div>
            </div>
            <div class="col-12 col-md-2">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="outro_responsavel_parentesco" name="outro_responsavel_parentesco" value="{{ $adolecente->outro_responsavel_parentesco }}" placeholder="Contato do Pai">
                  <label for="outro_responsavel_parentesco">Parentesco</label>
               </div>
            </div>
         </div>

         <div class="row">    
            <div class="col-12 col-md-4">
               <div class="form-floating mb-2">
                  <select class="form-select" id="contato_principal" name="contato_principal" required>                     
                     @foreach($contatos as $key => $dado)                     
                     <option value="{{ $key }}" {{ $adolecente->contato_principal == $key ? 'selected' : '' }}>{{ $key }} - {{ $dado }}</option>                     
                     @endforeach
                  </select>
                  <label for="contato_principal">* Contato principal</label>
               </div>
            </div>          
            <div class="col-12 col-md-4">
               <div class="form-floating mb-2">
                  <select class="form-select" id="possui_transporte" name="possui_transporte" required>                     
                     @foreach($transportes as $key => $dado)                     
                     <option value="{{ $key }}" {{ $adolecente->possui_transporte == $key ? 'selected' : '' }}>{{ $key }} - {{ $dado }}</option>                     
                     @endforeach
                  </select>
                  <label for="possui_transporte">* Reponsável possui transporte ?</label>
               </div>
            </div>           
            <div class="col-12 col-md-4">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="mora_com" name="mora_com" value="{{ $adolecente->mora_com }}" placeholder="mora_com" required>
                  <label for="mora_com">* O adolecente mora com quem ?</label>
               </div>
            </div>
         </div>

         <div class="row">    
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                     <select class="form-select" id="familiar_participa" name="familiar_participa" title="Grupo, pastoral, serviço ou movimento ?" required>
                        @foreach($simNao as $key => $dado)                     
                        <option value="{{ $key }}" {{ $adolecente->familiar_participa == $key ? 'selected' : '' }}>{{ $key }} - {{ $dado }}</option>                     
                        @endforeach
                     </select>
                     <label for="familiar_participa">
                        * Algum familiar participa de movimentos da igreja ?
                     </label>
               </div>
            </div>
    
            <div class="col-12 col-md-3">
               <div class="form-floating mb-2">
                     <input type="text" class="form-control text-uppercase" id="familiar_quem" name="familiar_quem" value="{{ $adolecente->familiar_quem }}" placeholder="Quem ?" disabled>
                     <label for="familiar_quem">Quem ?</label>
               </div>
            </div>
    
            <div class="col-12 col-md-3">
               <div class="form-floating mb-2">
                     <input type="text" class="form-control text-uppercase" id="familiar_grupo" name="familiar_grupo" value="{{ $adolecente->familiar_grupo }}" placeholder="Grupo, pastoral, serviço ou movimento" disabled>
                     <label for="familiar_grupo">Qual ?</label>
               </div>
            </div>
         </div>

         <div class="row">    
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                  <select class="form-select" id="tem_parente_inscrito" name="tem_parente_inscrito" required>                     
                     @foreach($simNao as $key => $dado)                     
                     <option value="{{ $key }}" {{ $adolecente->tem_parente_inscrito == $key ? 'selected' : '' }}>{{ $key }} - {{ $dado }}</option>                     
                     @endforeach
                  </select>
                  <label for="tem_parente_inscrito">
                     * Algum parente também está fazendo a inscrição ?
                  </label>
               </div>
            </div>
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="parente_inscrito_nome" name="parente_inscrito_nome" value="{{ $adolecente->parente_inscrito_nome }}" placeholder="Nome(s) do(s) parente(s)" disabled>
                  <label for="parente_inscrito_nome">Quem ?</label>
               </div>
            </div>
         </div>         

         <div class="row">    
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                  <select class="form-select" id="uso_medicamento" name="uso_medicamento" required>                     
                     @foreach($simNao as $key => $dado)                     
                     <option value="{{ $key }}" {{ $adolecente->uso_medicamento == $key ? 'selected' : '' }}>{{ $key }} - {{ $dado }}</option>                     
                     @endforeach
                  </select>
                  <label for="uso_medicamento">
                     * Faz uso de medicamentos ?
                  </label>
               </div>
            </div>
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="uso_medicamento_descricao" name="uso_medicamento_descricao" value="{{ $adolecente->uso_medicamento_descricao }}" placeholder="Detalhar com horários, quantidades e enviar na mala!" disabled>
                  <label for="uso_medicamento_descricao">Detalhar com horários, quantidades e enviar na mala!</label>
               </div>
            </div>
         </div>         

         <div class="row">    
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                  <select class="form-select" id="tratamento_saude" name="tratamento_saude" required>                     
                     @foreach($simNao as $key => $dado)                     
                     <option value="{{ $key }}" {{ $adolecente->tratamento_saude == $key ? 'selected' : '' }}>{{ $key }} - {{ $dado }}</option>                     
                     @endforeach
                  </select>
                  <label for="tratamento_saude">
                     * Faz tratamento de saúde ?
                  </label>
               </div>
            </div>
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="tratamento_saude_descricao" name="tratamento_saude_descricao" value="{{ $adolecente->tratamento_saude_descricao }}" placeholder="Detalhar a necessidade de acompanhamento." disabled>
                  <label for="tratamento_saude_descricao">Detalhar a necessidade de acompanhamento.</label>
               </div>
            </div>
         </div>         

         <div class="row">    
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                  <select class="form-select" id="restricao_alimentar" name="restricao_alimentar" required>                     
                     @foreach($simNao as $key => $dado)                     
                     <option value="{{ $key }}" {{ $adolecente->restricao_alimentar == $key ? 'selected' : '' }}>{{ $key }} - {{ $dado }}</option>                     
                     @endforeach
                  </select>
                  <label for="restricao_alimentar">
                     * Possui restrição alimentar ?
                  </label>
               </div>
            </div>
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="restricao_alimentar_descricao" name="restricao_alimentar_descricao" value="{{ $adolecente->restricao_alimentar_descricao }}" placeholder="Detalhar a restrição alimentar." disabled>
                  <label for="restricao_alimentar_descricao">Detalhar a restrição alimentar.</label>
               </div>
            </div>
         </div>         

         <div class="row">    
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                  <select class="form-select" id="alergia" name="alergia" required>                     
                     @foreach($simNao as $key => $dado)                     
                     <option value="{{ $key }}" {{ $adolecente->alergia == $key ? 'selected' : '' }}>{{ $key }} - {{ $dado }}</option>                     
                     @endforeach
                  </select>
                  <label for="alergia">
                     * Possii alergias ?
                  </label>
               </div>
            </div>
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="alergia_descricao" name="alergia_descricao" value="{{ $adolecente->alergia_descricao }}" placeholder="Detalhar a(s) alergia(s)." disabled>
                  <label for="alergia_descricao">Detalhar a(s) alergia(s).</label>
               </div>
            </div>
         </div>         

         <div class="row">    
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                  <select class="form-select" id="espectro_autista" name="espectro_autista" required>                     
                     @foreach($simNao as $key => $dado)                     
                     <option value="{{ $key }}" {{ $adolecente->espectro_autista == $key ? 'selected' : '' }}>{{ $key }} - {{ $dado }}</option>                     
                     @endforeach
                  </select>
                  <label for="espectro_autista">
                     * O adolecente está dentro o espectro autista ?
                  </label>
               </div>
            </div>
            <div class="col-12 col-md-6">
               <div class="form-floating mb-2">
                  <input type="text" class="form-control text-uppercase" id="espectro_autista_descricao" name="espectro_autista_descricao" value="{{ $adolecente->espectro_autista_descricao }}" placeholder="Detalhar a(s) espectro_autista(s)." disabled>
                  <label for="espectro_autista_descricao">Detalhar maiores informações.</label>
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