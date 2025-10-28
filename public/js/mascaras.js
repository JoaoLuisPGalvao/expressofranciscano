$(document).ready(function(){
    $('.maskCpf').mask('000.000.000-00', {reverse: true});
});

$(document).ready(function(){
    $('.maskContato').mask('(00) 00000-0000 / (00) 00000-0000');
});

$(document).ready(function(){
    $('.maskCep').mask('00000-000', {reverse: true});
});

$(document).ready(function(){
    $('.maskValor').mask('#.##0,00', {reverse: true});
});