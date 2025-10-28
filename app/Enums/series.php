<?php

namespace App\Enums;

class Series{

    public const PRIMEIRO_ANO = 1;
    public const SEGUNDO_ANO  = 2;
    public const TERCEIRO_ANO = 3;
    public const QUARTO_ANO   = 4;
    public const QUINTO_ANO   = 5;
    public const SEXTO_ANO    = 6;
    public const SETIMO_ANO   = 7;
    public const OITAVO_ANO   = 8;
    public const NONO_ANO     = 9;

    public static function lista(){
        return [
            self::PRIMEIRO_ANO  => 'PRIMEIRO ANO',
            self::SEGUNDO_ANO   => 'SEGUNDO ANO',
            self::TERCEIRO_ANO  => 'TERCEIRO ANO',
            self::QUARTO_ANO    => 'QUARTO ANO',
            self::QUINTO_ANO    => 'QUINTO ANO',
            self::SEXTO_ANO     => 'SEXTO ANO',
            self::SETIMO_ANO    => 'SÉTIMO ANO',
            self::OITAVO_ANO    => 'OITAVO ANO',
            self::NONO_ANO      => 'NONO ANO',
        ];
    }
}

?>