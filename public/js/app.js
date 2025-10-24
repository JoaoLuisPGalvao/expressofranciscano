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

//Função para buscar o cep e carregar no formulario
document.getElementById('endereco_cep').addEventListener('blur', async function() {
    let cep = this.value.replace(/\D/g, '');

    if (cep.length !== 8) {
        alert('CEP inválido!');
        return;
    }

    document.getElementById('endereco_rua').value = 'Carregando...';

    try {
        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        const data = await response.json();

        if (data.erro) {
            alert('CEP não encontrado!');
            document.getElementById('endereco_rua').value = '';
            return;
        }

        document.getElementById('endereco_rua').value = data.logradouro;
        document.getElementById('endereco_bairro').value = data.bairro;
        document.getElementById('endereco_cidade').value = data.localidade;
        document.getElementById('endereco_estado').value = data.uf;
    } catch (error) {
        alert('Erro ao buscar o endereço. Tente novamente.');
        document.getElementById('endereco_rua').value = '';
    }
});