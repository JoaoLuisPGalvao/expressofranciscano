$(document).ready(function(){
    $('.maskDataBase').mask('00/00');
});

$(document).ready(function() {
    $('.maskInscFederal').on('input', function() {
        var tamanho = $(this).val().replace(/\D/g, '').length;

        if(tamanho < 12){
            if(tamanho < 11){
                $(this).mask('000.000.000-00', {reverse: true});  
            }else{
                $(this).mask('00.000.00000/00', {reverse: true}); 
            }
        }else{
            $(this).mask('00.000.000/0000-00', {reverse: true});
        }
    });
});

$(document).ready(function(){
    $('.maskInscEstadual').mask('#.##0.000.000-0', {reverse: true});
});

$(document).ready(function(){
    $('.maskReciboDirf').mask('00.00.00.00.00-00', {reverse: true});
});

$(document).ready(function(){
    $('.maskTelefone').mask('(00) 0000-0000 / (00) 0000-0000');
});

$(document).ready(function(){
    $('.maskValor').mask('#.##0,00', {reverse: true});
});

$(document).ready(function(){
    $('.maskCrc').mask('ZZ000000/Z-0', {
        translation: {
            'Z': { pattern: /[A-Za-z0-9]/ }
        }
    });
});