<?php

namespace App\Enums;

class NivelUser{

    public const ADMINISTRADOR = 1;
    public const MASTER        = 2;
    public const BASICO        = 3;

    public static function nivelUser(){
        return [
            self::ADMINISTRADOR => 'Administrador',
            self::MASTER        => 'Master',
            self::BASICO        => 'Básico',
        ];
    }
}

?>