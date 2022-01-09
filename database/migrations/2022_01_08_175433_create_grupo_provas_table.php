<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupoProvasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_provas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nivelamento_id')->constrained('nivelamentos');
            $table->foreignId('prova_id')->nullable()->constrained('provas');
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
        Schema::dropIfExists('grupo_provas');
    }
}
