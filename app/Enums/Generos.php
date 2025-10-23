<?php

namespace App\Enums;

class Generos{

    public const MASCULINO = 1;
    public const FEMININO  = 2;

    public static function generos(){
        return [
            self::MASCULINO  => 'Mascuilo',
            self::FEMININO   => 'Feminino',
        ];
    }
}

?>