<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupoAlternativasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_alternativas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('questao_id')->constrained('questoes');
            $table->foreignId('alternativa_id')->nullable()->constrained('alternativas');
            $table->dateTime('data_criacao');
            $table->dateTime('data_alteracao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupo_alternativas');
    }
}