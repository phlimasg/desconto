<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidatos', function (Blueprint $table) {
            $table->increments('id_cand');
            $table->string('nome_cand');
            $table->date('dtnasc_cand');
            $table->string('tel_cand');
            $table->string('cep_cand');
            $table->string('rua_cand');
            $table->string('bairro_cand');
            $table->string('cidade_cand');
            $table->string('estado_cand');
            $table->integer('aluno_novo');
            $table->string('aluno_novo_origem_cand')->nullable();
            $table->string('desc_cand')->nullable();
            $table->string('escolaridade_cand');
            $table->string('deficiencia_cand')->nullable();
            $table->string('status_id')->nullable();
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
        Schema::dropIfExists('candidatos');
    }
}
