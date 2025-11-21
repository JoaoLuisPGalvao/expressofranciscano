<?php

namespace App\Enums;

class Equipes{

    public const PAZ_E_BEM              = 1;
    public const ARRUMACAO              = 2;
    public const MERCEARIA              = 3;
    public const IRMAO_SOL_IRMA_LUA     = 4;
    public const PRODUCAO               = 5;
    public const IMAGEM_ACAO            = 6;
    public const PERFEITA_ALEGRIA       = 7;
    public const BASTIDORES             = 8;
    public const MERENDA                = 9;
    public const POUPANCA               = 10;
    public const COMUNICACAO_INFORMACAO = 11;
    public const MESTRE_CUCA            = 12;
    public const CAPELINHA              = 13;
    public const LOCOMOTORES            = 14;
    public const GUARDIOES              = 15;
    public const SALA_COMANDO           = 16;
    public const MAQUINISTAS            = 17;

    public static function equipes(){
        return [
            self::PAZ_E_BEM                 => 'Paz e Bem',
            self::ARRUMACAO                 => 'Arrumação',
            self::MERCEARIA                 => 'Marcearia',
            self::IRMAO_SOL_IRMA_LUA        => 'Irmão Sol e Irmã Lua',
            self::PRODUCAO                  => 'Produção',
            self::IMAGEM_ACAO               => 'Imagem e Ação',
            self::PERFEITA_ALEGRIA          => 'Perfeita Alegria',
            self::BASTIDORES                => 'Bastidores',
            self::MERENDA                   => 'Merenda',
            self::POUPANCA                  => 'Poupança',
            self::COMUNICACAO_INFORMACAO    => 'Comunicação e Informação',
            self::MESTRE_CUCA               => 'Mestre Cuca',
            self::CAPELINHA                 => 'Capelinha',
            self::LOCOMOTORES               => 'Locomotores',
            self::GUARDIOES                 => 'Guardiões',
            self::SALA_COMANDO              => 'Sala de Comando',
            self::MAQUINISTAS               => 'Maquinistas',
        ];
    }
}

?>