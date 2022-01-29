<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNivelamentosProvasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nivelamentos_provas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nivelamento_id')->constrained('nivelamentos');
            $table->foreignId('prova_id')->constrained('provas');
            $table->string('usuario_criador', 255);
            $table->string('usuario_atualizacao', 255);
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
        Schema::dropIfExists('nivelamentos_provas');
    }
}
