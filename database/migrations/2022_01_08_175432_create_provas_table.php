<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nivelamento_id')->constrained('nivelamentos');
            $table->string('nome', 50);
            $table->integer('qtd_questao');
            $table->integer('media_apr');
            $table->string('mensagem_apr', 255);
            $table->string('mensagem_rep', 255);
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
        Schema::dropIfExists('provas');
    }
}
