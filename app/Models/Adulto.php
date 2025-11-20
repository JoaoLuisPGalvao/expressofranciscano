<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Adulto extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [  
        'nome',            
        'perfil',
        'idade',
        'ano_expresso', 
        'endereco_cep',         
        'endereco_rua',
        'endereco_numero',
        'endereco_bairro',
        'endereco_cidade',
        'endereco_estado',
        'endereco_complemento', 
        'contato',
        'instagram',        
        'frequenta_paroquia',
        'qual_paroquia',
        'participou_expresso',
        'ano_participacao',
        'serviu_expresso',            
        'experiencias_servico',        
        'vagao_1',
        'vagao_2',
        'vagao_3',
        'participa_pastoral',
        'qual_pastoral',
        'serviu_ejc_ecc',        
        'foto',
        'status',      
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'nome',            
        'perfil',
        'idade',
        'telefone',
        'instagram',
        'endereco_cep',         
        'endereco_rua',
        'endereco_numero',
        'endereco_bairro',
        'endereco_cidade',
        'endereco_estado',
        'endereco_complemento',
        'frequenta_paroquia',
        'qual_paroquia',
        'participou_encontros',
        'anos_participados',
        'serviu_outros_encontros',            
        'experiencias_outros_encontros',
        'participa_pastoral',
        'qual_pastoral',
        'serviu_ejc_ecc',        
        'foto',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [      
            'perfil'                    => 'int',
            'frequenta_paroquia'        => 'int',            
            'participou_encontros'      => 'int',           
            'serviu_outros_encontros'   => 'int',
            'vagao_1'                   => 'int',
            'vagao_2'                   => 'int',            
            'vagao_3'                   => 'int',           
            'participa_pastoral'        => 'int',
            'serviu_ejc_ecc'            => 'int',           
            'status'                    => 'int',           
            'ano_expresso'              => 'int', 
    ];   
}