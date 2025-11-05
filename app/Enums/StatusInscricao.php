<?php

namespace App\Enums;

class StatusInscricao{

    public const PENDENTE    = 1;
    public const VISUALIZADO = 2;
    public const SELECIONADO = 3;

    public static function lista(){
        return [
            self::PENDENTE    => 'Pendente',
            self::VISUALIZADO => 'Visualizado',
            self::SELECIONADO => 'Selecionado',
        ];
    }
}

?>