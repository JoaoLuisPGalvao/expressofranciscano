<?php

namespace App\Enums;

class Transportes{

    public const NAO        = 1;
    public const CARRO      = 2;
    public const MOTO       = 3;
    public const CARRO_MOTO = 4;

    public static function lista(){
        return [
            self::NAO        => 'NÃO',
            self::CARRO      => 'SIM, CARRO',
            self::MOTO       => 'SIM, MOTO',
            self::CARRO_MOTO => 'SIM, CARRO E MOTO',
        ];
    }
}

?>