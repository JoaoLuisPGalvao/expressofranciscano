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
document.addEventListener('DOMContentLoaded', () => {
    const cepInput = document.getElementById('endereco_cep');
    if (!cepInput) return; // Sai se o input não existir

    cepInput.addEventListener('blur', async function() {
        let cep = this.value.replace(/\D/g, '');
        if (cep.length !== 8) {
            alert('CEP inválido!');
            return;
        }

        const ruaInput = document.getElementById('endereco_rua');
        const bairroInput = document.getElementById('endereco_bairro');
        const cidadeInput = document.getElementById('endereco_cidade');
        const estadoInput = document.getElementById('endereco_estado');

        if (ruaInput) ruaInput.value = 'Carregando...';

        try {
            const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
            const data = await response.json();

            if (data.erro) {
                alert('CEP não encontrado!');
                if (ruaInput) ruaInput.value = '';
                return;
            }

            if (ruaInput) ruaInput.value = data.logradouro.toUpperCase();
            if (bairroInput) bairroInput.value = data.bairro.toUpperCase();
            if (cidadeInput) cidadeInput.value = data.localidade.toUpperCase();
            if (estadoInput) estadoInput.value = data.uf.toUpperCase();

        } catch (error) {
            alert('Erro ao buscar o endereço. Tente novamente.');
            if (ruaInput) ruaInput.value = '';
            console.error(error);
        }
    });
});

//Função para habilitar e desabilitar a linha de informações do formulário do econtrista
document.addEventListener('DOMContentLoaded', function () {

    // Função genérica para habilitar/desabilitar campos
    function configurarToggle(selectId, campos) {
        const select = document.getElementById(selectId);
        if (!select) return; // sai se o select não existir

        function toggleCampos() {
            const habilitar = select.value === '1';

            campos.forEach(id => {
                const campo = document.getElementById(id);
                if (!campo) return;

                campo.disabled = !habilitar;

                if (habilitar) {
                    campo.setAttribute('required', 'required');
                } else {
                    campo.removeAttribute('required');
                    campo.value = '';
                }
            });
        }

        toggleCampos(); // mantém estado em caso de old()
        select.addEventListener('change', toggleCampos);
    }

    // Configurações específicas de cada seção
    configurarToggle('estuda', ['escola', 'serie', 'turno']);
    configurarToggle('familiar_participa', ['familiar_quem', 'familiar_grupo']);
    configurarToggle('tem_parente_inscrito', ['parente_inscrito_nome']);
    configurarToggle('uso_medicamento', ['uso_medicamento_descricao']);
    configurarToggle('tratamento_saude', ['tratamento_saude_descricao']);
    configurarToggle('restricao_alimentar', ['restricao_alimentar_descricao']);
    configurarToggle('alergia', ['alergia_descricao']);
    configurarToggle('espectro_autista', ['espectro_autista_descricao']);
});
