<!-- Modal -->
<div class="modal fade" id="modalAlterarSenha" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <form action="{{route('users.alterarSenha', ['user' => auth()->user()])}}" method="POST" enctype="multipart/form-data">
   @csrf
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="exampleModalLabel">ALTERAR SENHA</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">         
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-12">                        
                        <div class="form-floating mb-3">
                           <input type="text" class="form-control text-uppercase" id="name_reset" name="name_reset" value="{{ auth()->user()->name }}" placeholder="Nome" required>
                           <label for="name_reset">* Usuário</label>
                        </div>
                     </div>
                  </div>
                  <div class="row">            
                     <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                           <input type="password" class="form-control" id="password_reset" name="password_reset" placeholder="Digite a senha" required>
                           <label for="password_reset">* Senha atual</label>                  
                        </div>
                     </div>
                     <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                           <input type="password" class="form-control" id="password_new" name="password_new" placeholder="Nova senha" required>
                           <label for="password_new">* Nova senha</label>                  
                        </div>
                     </div>
                  </div>
               </div>                  
            </div>
            <div class="modal-footer">
               <x-btn-cancelar title="Cancelar"></x-btn-cancelar>
               <x-btn-atualizar title="Atualizar"></x-btn-atualizar>
            </div>
         </div>
      </div>
   </form>
</div>