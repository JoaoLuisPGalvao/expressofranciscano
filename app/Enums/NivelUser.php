<?php

namespace App\Enums;

class NivelUser{

    public const ADMINISTRADOR  = 1;
    public const MAQUINISTA     = 2;
    public const LOCOMOTOR      = 3;
    public const MEMBRO         = 4;

    public static function nivelUser(){
        return [
            self::ADMINISTRADOR => 'Administrador',
            self::MAQUINISTA    => 'Maquinista',
            self::LOCOMOTOR     => 'Locomotor',
            self::MEMBRO        => 'Membro',
        ];
    }
}

?>