<?php

namespace App\Enums;

class Equipes{

    public const PAZ_E_BEM              = 1;
    public const MESTRE_CUCA            = 2;
    public const IMAGEM_E_ACAO          = 3;
    public const PERFEITA_ALEGRIA       = 4;
    public const INFORMACAO_COMUNICACAO = 5;


    public static function equipes(){
        return [
            self::PAZ_E_BEM              => 'Paz e Bem',
            self::MESTRE_CUCA            => 'Mestre Cuca',
            self::IMAGEM_E_ACAO          => 'Imagem e Ação',
            self::PERFEITA_ALEGRIA       => 'Perfeita Alegria',
            self::INFORMACAO_COMUNICACAO => 'Informação e Comunicação',
        ];
    }
}

?>