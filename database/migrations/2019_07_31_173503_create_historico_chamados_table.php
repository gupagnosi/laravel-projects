<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricoChamadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_chamados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente')->unsigned();
            $table->foreign('cliente')->references('id')->on('usuarios');
            $table->integer('responsavel')->unsigned();
            $table->foreign('responsavel')->references('id')->on('usuarios');
            $table->integer('chamado')->unsigned();
            $table->foreign('chamado')->references('id')->on('chamados');
            $table->string('assunto');
            $table->string('anexo');
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
        Schema::dropIfExists('historico_chamados');
    }
}
