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
            $table->string('cpf', 14)->unique();
            $table->date('data_nasc');
            $table->integer('genero');
            $table->integer('ano_expresso');
            $table->string('pai_nome');
            $table->string('pai_contato');
            $table->string('mae_nome');
            $table->string('mae_contato');
            $table->integer('pais_casados');
            $table->string('endereco_rua');
            $table->string('endereco_numero', 10);
            $table->string('endereco_bairro');
            $table->string('endereco_cidade');
            $table->string('endereco_estado');
            $table->string('endereco_cep', 10);
            $table->integer('status');
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
