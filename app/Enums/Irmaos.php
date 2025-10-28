<?php

namespace App\Enums;

class Irmaos{

    public const NAO    = 1;
    public const UM     = 2;
    public const DOIS   = 3;
    public const TRES   = 4;
    public const QUATRO = 5;
    public const CINCO  = 6;

    public static function lista(){
        return [
            self::NAO    => 'NÃO',
            self::UM     => 'SIM, UM',
            self::DOIS   => 'SIM, DOIS',
            self::TRES   => 'SIM, TRÊS',
            self::QUATRO => 'SIM, QUATRO',
            self::CINCO  => 'SIM, CINCO',
        ];
    }
}

?>