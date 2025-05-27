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
        Schema::create('configuracoes_site', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable(); // Caminho ou nome da imagem do ícone
            $table->string('logo')->nullable(); // Caminho ou nome da imagem do logo
            $table->string('sobre_roda_pe', 2000)->nullable();
            $table->string('sobre1', 2000)->nullable();
            $table->string('sobre2', 2000)->nullable();
            $table->string('textonossotime')->nullable(); // Cor do texto "nosso time" (ex: #FFF)
            $table->string('sobre1cor')->nullable(); // Cor do sobre1
            $table->string('sobre2cor')->nullable(); // Cor do sobre2
            $table->string('telefone')->nullable();
            $table->string('email')->nullable();
            $table->string('localizacao',2000)->nullable();
            $table->string('cor_background')->nullable();
            $table->string('corhouve')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracoes_site');
    }
};
