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
        'cpf',            
        'data_nasc',
        'genero',
        'ano_expresso',
        'pai_nome',
        'pai_contato',
        'mae_nome',
        'mae_contato',
        'pais_casados',
        'endereco_rua',
        'endereco_numero',
        'endereco_bairro',
        'endereco_cidade',
        'endereco_estado',
        'endereco_cep',
        'status'        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'nome',
        'cpf',            
        'data_nasc',
        'pai_nome',
        'pai_contato',
        'mae_nome',
        'mae_contato',
        'endereco_rua',
        'endereco_numero',
        'endereco_bairro',
        'endereco_cidade',
        'endereco_estado',
        'endereco_cep',           
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [       
        'data_nasc'     => 'date',
        'genero'        => 'int',
        'ano_expresso'  => 'int', 
        'pais_casados'  => 'int', 
        'status'        => 'int',          
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