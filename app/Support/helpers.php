<?php

use App\Enums\Fraternidades;
use Carbon\Carbon;

function validarCPF($cpf) {
    // Remove qualquer caractere que não seja número
    $cpf = preg_replace('/\D/', '', $cpf);

    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }

        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

// Função para parsear valores numéricos formatados
function parseFloat($value) {
    return floatval(str_replace(',', '.', str_replace('.', '', $value)));
}

// Função para formatar valores em moeda
function formatCurrency($value) {
    return 'R$ ' . number_format($value, 2, ',', '.');
}

// Função para formatar valores em data
function formatDate($value){
    return Carbon::parse($value)->format('d/m/Y');
}

//Função para calcular a idade do jovem em meses e alocar em uma fraternidade
function idadeFraternidades() {

    $ano     = 365.25;         // média de dias no ano
    $meioAno = $ano / 2;       // 6 meses = 182,625 dias

    return [
        Fraternidades::SAO_JOSE_OPERARIO   => ['min' => 0, 'max' => 11 * $ano + $meioAno],
        Fraternidades::ROSA_MISTICA        => ['min' => 11 * $ano + $meioAno + 1, 'max' => 12 * $ano + $meioAno],
        Fraternidades::SAO_PEDRO_SAO_PAULO => ['min' => 12 * $ano + $meioAno + 1, 'max' => 13 * $ano + $meioAno],
        Fraternidades::SANTA_CLARA         => ['min' => 13 * $ano + $meioAno + 1, 'max' => 15 * $ano],
        'dataEncontro'                     => '2025-10-31',
    ];
}

function calcularFraternidade($data_nasc){

    $faixas         = idadeFraternidades();  
    $dataNasc       = Carbon::parse($data_nasc);
    $dataEncontro   = Carbon::parse($faixas['dataEncontro']);
    $idadeDias      = $dataNasc->diffInDays($dataEncontro);

    // percorre apenas as fraternidades (ignorando 'dataEncontro')
    foreach ($faixas as $codigo => $limite) {
        if (!is_array($limite)) continue;

        if ($idadeDias >= $limite['min'] && $idadeDias <= $limite['max']) {
            return $codigo; // retorna o código da fraternidade
        }
    }

    return null; // caso não se enquadre em nenhuma
}