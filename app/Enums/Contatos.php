<?php

namespace App\Enums;

class Contatos{

    public const PAI        = 1;
    public const MAE        = 2;
    public const OUTRO_RESP = 3;

    public static function lista(){
        return [
            self::PAI        => 'PAI',
            self::MAE        => 'MÃE',
            self::OUTRO_RESP => 'OUTRO RESPONSÁVEL',
        ];
    }
}

?>