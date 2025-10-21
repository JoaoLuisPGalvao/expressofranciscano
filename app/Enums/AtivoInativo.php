<?php

namespace App\Enums;

class AtivoInativo{

    public const ATIVO   = 1;
    public const INATIVO = 2;

    public static function lista(){
        return [
            self::ATIVO   => 'Ativo',
            self::INATIVO => 'Inativo',
        ];
    }
}

?>