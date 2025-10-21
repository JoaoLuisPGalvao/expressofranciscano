var checkboxes = document.querySelectorAll("input[type = 'checkbox']")
function checkAll(myCheckbox){
    if(myCheckbox.checked == true){
        checkboxes.forEach(function(checkbox){
            checkbox.checked = true;
        });
    }
    else
    {
        checkboxes.forEach(function(checkbox){
            checkbox.checked = false;
        });			
    }
} 

$(document).ready(function(){
    $('#minhaTabela').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
        },
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'Todos']
        ],        
    });
});

const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

//CKEditor
const emailTextArea = document.querySelector('.emailTextArea');

if (emailTextArea) {
    ClassicEditor
        .create(emailTextArea)
        .catch(error => {
            console.error(error);
        });
}

function addProvento() {
    const proventoHtml = `
        <div class="provento-item">
            <div class="row">
                <div class="col-12 col-md-1">
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" id="flexCheckChecked" name="baseInssIrrfProvento[]" value="1" checked>                                            
                    </div>
                </div>   
                <div class="col-12 col-md-6">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="provento[]" placeholder="Provento" required>
                        <label for="provento">* Provento</label>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="input-group mb-2">
                        <span class="input-group-text">R$</span>
                        <div class="form-floating">
                            <input type="text" class="form-control maskValor" name="vl_provento[]" placeholder="Valor" required>
                            <label for="vl_provento">* Valor</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;

    document.getElementById('CampoProvento').insertAdjacentHTML('beforeend', proventoHtml);
    
    $('#CampoProvento .provento-item:last-child .maskValor').mask('#.##0,00', { reverse: true });
}    

function addDesconto() {
    const descontoHtml = `
        <div class="desconto-item">
            <div class="row">
                <div class="col-12 col-md-1">
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" id="flexCheckChecked" name="baseInssIrrfDesconto[]" value="1">                                            
                    </div>
                </div>     
                <div class="col-12 col-md-6">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="desconto[]" placeholder="Desconto" required>
                        <label for="desconto">* Desconto</label>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="input-group mb-2">
                        <span class="input-group-text">R$</span>
                        <div class="form-floating">
                            <input type="text" class="form-control maskValor" name="vl_desconto[]" placeholder="Valor" required>
                            <label for="vl_desconto">* Valor</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;

    document.getElementById('CampoDesconto').insertAdjacentHTML('beforeend', descontoHtml);

    $('#CampoDesconto .desconto-item:last-child .maskValor').mask('#.##0,00', { reverse: true });
}

function removerDesconto() {
    const descontos = document.querySelectorAll('#CampoDesconto .desconto-item');
    if (descontos.length > 0) {
        descontos[descontos.length - 1].remove();
    }
}

function removerProvento() {
    const proventos = document.querySelectorAll('#CampoProvento .provento-item');
    if (proventos.length > 0) {
        proventos[proventos.length - 1].remove();
    }
}

function removerCaracteres(elemento) {    
    var conteudo = elemento.innerText;
    
    var numeros = conteudo.replace(/\D/g, '');
    
    elemento.innerText = numeros;
}

function confirmarExclusao(event, id){

    event.preventDefault();

    Swal.fire({
        title: "Deseja realmente excluir este registro?",
        text: "Este processo é irreversível!",
        icon: "warning",
        iconColor: "#F27474",
        showCancelButton: true,
        cancelButtonColor: "#0D6EFD",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#DC3545",
        confirmButtonText: "Sim, excluir!",
        allowOutsideClick: false,
    }).then((result) => {
        if(result.isConfirmed){
            document.getElementById(`formExcluir${id}`).submit();
        }
    })
}

function confirmarBaixa(event, id){    

    event.preventDefault();

    Swal.fire({
        title: "A demanda desta empresa já foi entregue ?",            
        icon: "question",
        showCancelButton: true,
        cancelButtonColor: "#DC3545",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#198754",
        confirmButtonText: "Sim, baixar!",
        allowOutsideClick: false,
    }).then((result) => {
        if(result.isConfirmed){                
            let href = document.getElementById(`btnBaixar${id}`).getAttribute('href');                
            window.location.href = href;
        }
    })
} 

function confirmarLimpar(event, title, text){

    event.preventDefault();

    Swal.fire({
        title: title,    
        text: text,        
        icon: "warning",
        iconColor: "#F27474",
        showCancelButton: true,
        cancelButtonColor: "#DC3545",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#198754",
        confirmButtonText: "Confirmar",
        allowOutsideClick: false,
    }).then((result) => {
        if(result.isConfirmed){                
            let href = document.getElementById(`btnLimpar`).getAttribute('href');                
            window.location.href = href;
        }
    })
} 

function toggleValores(button) {

    // Seleciona todos os elementos que possuem valores a serem alternados
    const valores = document.querySelectorAll('[id^="valor"]');

    valores.forEach((valor) => {
        const valorOriginal = valor.getAttribute('data-original');
        
        if (valor.innerHTML.trim() === "R$ *****") {
            valor.innerHTML = valorOriginal;
        } else {
            valor.innerHTML = "R$ *****";
        }
    });

    // Alterna o ícone do botão
    const icon = button.querySelector('svg');

    if (icon.classList.contains('fa-eye-slash')) {
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
}

function divEmpresa(){    
    document.getElementById('empresaExterna').addEventListener('change', function() {
        const isChecked = this.checked;
        const empresaExternaFields = document.getElementById('empresaExternaFields');
        const empresaCadastradaFields = document.getElementById('empresaCadastradaFields');

        if (isChecked) {
            empresaExternaFields.classList.remove('d-none');
            empresaCadastradaFields.classList.add('d-none');
        } else {
            empresaExternaFields.classList.add('d-none');
            empresaCadastradaFields.classList.remove('d-none');
        }
    });
}

function validarSelectCustoFuncionario() {

    var optionSelect      = document.getElementById('tributacao').value;
    var optionSelectAnexo = document.getElementById('anexo').value;

    var anexo     = document.getElementById('anexo');
    var inss      = document.getElementById('inss');
    var rat       = document.getElementById('rat');
    var terceiros = document.getElementById('terceiros');

    // Lógica para o campo 'anexo'
    if (optionSelect == '3') {

        anexo.disabled = false;  
        anexo.required = true;      
    } else {

        anexo.disabled = true;
        anexo.required = false;
        anexo.value = '...';
    }

    // Lógica para os campos 'inss', 'rat' e 'terceiros'
    if (optionSelect == '3'){

        inss.disabled = true;
        rat.disabled = true;
        terceiros.disabled = true;
        inss.value = '0,00';
        rat.value = '0,00';
        terceiros.value = '0,00';

        if(optionSelectAnexo == '2'){

            inss.disabled = false;
            rat.disabled = false;            
            inss.value = '';
            rat.value = '';           
        }        
    }
    else if (optionSelect == '4') {

        inss.disabled = true;
        rat.disabled = true;
        terceiros.disabled = true;
        inss.value = '8,00';
        rat.value = '0,80';
        terceiros.value = '0,00';
    } else if (optionSelect == '5') {
        
        inss.disabled = true;
        rat.disabled = true;
        terceiros.disabled = true;
        inss.value = '3,00';
        rat.value = '0,00';
        terceiros.value = '0,00';
    } else {
        inss.disabled = false;
        rat.disabled = false;
        terceiros.disabled = false;
        inss.value = '';
        rat.value = '';
        terceiros.value = '';
    }
}

function ativaDataStatusEmpresa(){

    var optionSelect      = document.getElementById('status_empresa').value;
    var dataStatusEmpresa = document.getElementById('data_status_empresa');

    if (optionSelect == 2) {

        dataStatusEmpresa.disabled = false;
        dataStatusEmpresa.required = true;           
    } else {

        dataStatusEmpresa.disabled = true; 
        dataStatusEmpresa.required = false;       
    }
}

$(document).ready(function() {
    $('#destinatarios').select2({
        tags: false,
        tokenSeparators: [',', ' '],
        placeholder: "Digite ou selecione as empresas"
    });
});

//Efeito spinner para os botões
document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".btn-submit-loading");

    buttons.forEach((btn) => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();

            const form = btn.closest("form");

            if (form && form.reportValidity()) {                
                btn.disabled = true;

                btn.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    ${btn.dataset.loadingText || "Enviando..."}
                `;

                setTimeout(() => {
                    form.submit();
                }, 2000);
            }
        });
    });
});

function addDocumento() {
    const container = document.getElementById('CampoDocumento');

    // Cria o elemento principal
    const item = document.createElement('div');
    item.className = 'row documento-item align-items-center';    

    item.innerHTML = `
        <div class="col-7 col-md-4">
            <div class="form-floating mb-2">
                <input type="text" class="form-control" name="documento[]" placeholder="Documento" required >
                <label>* Documento</label>
            </div>
        </div> 
        <div class="col-5 col-md-2">
            <div class="form-floating mb-2">
                <input type="date" class="form-control" name="vencimento[]" placeholder="Vencimento" required >
                <label>* Vencimento</label>
            </div>
        </div>
        <div class="col-10 col-md-5">
            <div class="form-floating mb-2">
                <input type="file" class="form-control" name="arquivo[]" accept=".pdf" required>
                <label>Arquivo (PDF)</label>
            </div>
        </div>
        <div class="col-2 col-md-1 text-center mb-2">
            <button type="button" class="btn btn-link p-0 remove-documento" title="Remover">
                <i class="fas fa-trash-alt fa-lg text-danger"></i>
            </button>
        </div>

        <hr>
    `;

    container.appendChild(item);
}

// Delegação de evento (melhor que reatribuir listeners a cada novo item)
document.addEventListener('click', function (e) {
    if (e.target.closest('.remove-documento')) {
        e.target.closest('.documento-item').remove();
    }
});
