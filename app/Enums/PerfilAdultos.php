<?php

namespace App\Enums;

class PerfilAdultos{

    public const JOVEM  = 1;
    public const CASAL  = 2;
    public const OUTROS = 3;

    public static function lista(){
        return [
            self::JOVEM  => 'Jovem',
            self::CASAL  => 'Casal',
            self::OUTROS => 'Outros',
        ];
    }
}

?>