<?php

namespace App\Enums;

class Fraternidades{

    public const SAO_JOSE_OPERARIO   = 1;
    public const ROSA_MISTICA        = 2;
    public const SAO_PEDRO_SAO_PAULO = 3;
    public const SANTA_CLARA         = 4;

    public static function lista(){
        return [
            self::SAO_JOSE_OPERARIO     => 'São Jose Operário',
            self::ROSA_MISTICA          => 'Rosa Mística',
            self::SAO_PEDRO_SAO_PAULO   => 'São Pedro e São Paulo',
            self::SANTA_CLARA           => 'Santa Clara',
        ];
    }
}

?>