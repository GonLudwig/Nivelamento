<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvasComponentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provas_componentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prova_id')->constrained('provas');
            $table->foreignId('componente_id')->constrained('componentes');
            $table->integer('quantidade_questao');
            $table->string('usuario_criador', 255);
            $table->string('usuario_atualização', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provas_componentes');
    }
}
