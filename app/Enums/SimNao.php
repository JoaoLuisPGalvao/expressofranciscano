<?php

namespace App\Enums;

class SimNao{

    public const SIM = 1;
    public const NAO = 2;

    public static function lista(){
        return [
            self::SIM => 'Sim',
            self::NAO => 'Não',
        ];
    }
}

?>