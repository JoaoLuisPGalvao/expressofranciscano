<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Encontrista extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [  
        'nome',            
        'data_nasc',
        'genero',
        'ano_expresso',
        'endereco_cep',         
        'endereco_rua',
        'endereco_numero',
        'endereco_bairro',
        'endereco_cidade',
        'endereco_estado',
        'endereco_complemento',
        'estuda',
        'escola',
        'serie',
        'turno',
        'tem_irmaos',            
        'pais_casados',
        'pai_nome',
        'pai_contato',
        'mae_nome',
        'mae_contato',
        'outro_responsavel_nome',
        'outro_responsavel_contato',
        'outro_responsavel_parentesco',
        'contato_principal',
        'possui_transporte',
        'mora_com',
        'familiar_participa',
        'familiar_quem',
        'familiar_grupo',
        'tem_parente_inscrito',
        'parente_inscrito_nome',
        'uso_medicamento',
        'uso_medicamento_descricao', 
        'tratamento_saude',
        'tratamento_saude_descricao',
        'restricao_alimentar',
        'restricao_alimentar_descricao',
        'alergia',
        'alergia_descricao',
        'espectro_autista',
        'espectro_autista_descricao',
        'foto',
        'status',            
        'created_by_name',
        'updated_by_name',
        'deleted_by_name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'nome',            
        'data_nasc',
        'endereco_cep',         
        'endereco_rua',
        'endereco_numero',
        'endereco_bairro',
        'endereco_cidade',
        'endereco_estado',
        'endereco_complemento',
        'estuda',
        'escola',
        'serie',
        'turno',        
        'pai_nome',
        'pai_contato',
        'mae_nome',
        'mae_contato',
        'outro_responsavel_nome',
        'outro_responsavel_contato',
        'outro_responsavel_parentesco',
        'contato_principal',        
        'uso_medicamento',
        'uso_medicamento_descricao', 
        'tratamento_saude',
        'tratamento_saude_descricao',
        'restricao_alimentar',
        'restricao_alimentar_descricao',
        'alergia',
        'alergia_descricao',
        'espectro_autista',
        'espectro_autista_descricao',       
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [      
            'genero'                => 'int',
            'ano_expresso'          => 'int',            
            'estuda'                => 'int',           
            'serie'                 => 'int',
            'turno'                 => 'int',
            'tem_irmaos'            => 'int',            
            'pais_casados'          => 'int',           
            'contato_principal'     => 'int',
            'possui_transporte'     => 'int',           
            'familiar_participa'    => 'int',           
            'tem_parente_inscrito'  => 'int',            
            'uso_medicamento'       => 'int',            
            'tratamento_saude'      => 'int',            
            'restricao_alimentar'   => 'int',            
            'alergia'               => 'int',            
            'espectro_autista'      => 'int',   
            'status'                => 'int',
    ];

    public function createdByName(){
        return $this->belongsTo(Encontrista::class, 'created_by_name');
    }

    public function updatedByName(){
        return $this->belongsTo(Encontrista::class, 'updated_by_name');
    }

    public function deletedByName(){
        return $this->belongsTo(Encontrista::class, 'deleted_by_name');
    }
}