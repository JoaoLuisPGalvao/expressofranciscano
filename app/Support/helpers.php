<?php

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