<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComposicaoFamiliarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('composicao_familiars', function (Blueprint $table) {
            $table->increments('id_comp');
            $table->string('nome_comp');
            $table->string('parentesco_comp');
            $table->integer('idade_comp');
            $table->string('escolaridade_comp');
            $table->string('profissao_comp');
            $table->string('salario_comp');
            $table->bigInteger('candidato_id_cand');
            $table->foreign('candidato_id_cand')->references('id_cand')->on('candidatos');
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
        Schema::dropIfExists('composicao_familiars');
    }
}
