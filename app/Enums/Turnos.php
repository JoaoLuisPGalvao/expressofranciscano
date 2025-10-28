<?php

namespace App\Enums;

class Turnos{

    public const MANHA  = 1;
    public const TARDE  = 2;
    public const NOITE  = 3;

    public static function lista(){
        return [
            self::MANHA => 'MANHÃ',
            self::TARDE => 'TARDE',
            self::NOITE => 'NOITE',
        ];
    }
}

?>