<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('adultos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');            
            $table->integer('perfil'); 
            $table->string('idade');
            $table->integer('ano_expresso');     
            $table->string('endereco_cep', 10);          
            $table->string('endereco_rua');
            $table->string('endereco_numero', 10)->nullable();
            $table->string('endereco_bairro');
            $table->string('endereco_cidade');
            $table->string('endereco_estado');
            $table->string('endereco_complemento');   
            $table->string('contato')->nullable();
            $table->string('instagram')->nullable();               
            $table->integer('frequenta_paroquia');
            $table->string('qual_paroquia')->nullable();            
            $table->integer('participou_expresso');
            $table->string('ano_participacao')->nullable();            
            $table->integer('serviu_expresso');
            $table->string('experiencias_servico')->nullable();            
            $table->integer('vagao_1');
            $table->integer('vagao_2')->nullable();
            $table->integer('vagao_3')->nullable();            
            $table->integer('participa_pastoral');
            $table->string('qual_pastoral')->nullable();            
            $table->integer('serviu_ejc_ecc');
            $table->string('foto')->nullable();          
            $table->integer('status');                    
            $table->timestamps();
            $table->softDeletes();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adultos');
    }
};
