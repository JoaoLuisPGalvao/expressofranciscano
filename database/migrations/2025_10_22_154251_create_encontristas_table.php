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
        Schema::create('encontristas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');            
            $table->date('data_nasc');
            $table->integer('genero');
            $table->integer('ano_expresso');
            $table->string('endereco_cep', 10);          
            $table->string('endereco_rua');
            $table->string('endereco_numero', 10)->nullable();
            $table->string('endereco_bairro');
            $table->string('endereco_cidade');
            $table->string('endereco_estado');
            $table->string('endereco_complemento');
            $table->integer('estuda');
            $table->string('escola')->nullable();
            $table->integer('serie')->nullable();
            $table->integer('turno')->nullable();
            $table->integer('tem_irmaos');            
            $table->integer('pais_casados');
            $table->string('pai_nome')->nullable();
            $table->string('pai_contato', 50)->nullable();
            $table->string('mae_nome');
            $table->string('mae_contato', 50);  
            $table->string('outro_responsavel_nome')->nullable();
            $table->string('outro_responsavel_contato', 50)->nullable();
            $table->string('outro_responsavel_parentesco', 50)->nullable();
            $table->integer('contato_principal');
            $table->integer('possui_transporte');
            $table->string('mora_com', 50);
            $table->integer('familiar_participa');
            $table->string('familiar_quem', 50)->nullable();
            $table->string('familiar_grupo', 50)->nullable();
            $table->integer('tem_parente_inscrito');
            $table->string('parente_inscrito_nome', 100)->nullable(); 
            $table->integer('uso_medicamento');
            $table->string('uso_medicamento_descricao')->nullable(); 
            $table->integer('tratamento_saude');
            $table->string('tratamento_saude_descricao')->nullable();
            $table->integer('restricao_alimentar');
            $table->string('restricao_alimentar_descricao')->nullable();
            $table->integer('alergia');
            $table->string('alergia_descricao')->nullable();
            $table->integer('espectro_autista');
            $table->string('espectro_autista_descricao')->nullable();
            $table->string('foto')->nullable();          
            $table->integer('fraternidade');  
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_by_name')->nullable();
            $table->string('updated_by_name')->nullable();
            $table->string('deleted_by_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encontristas');
    }
};
