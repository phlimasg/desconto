<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoFamiliarReceitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_familiar_receitas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('receita');
            $table->string('tipo');
            $table->string('descricao')->nullable();
            $table->unsignedBigInteger('candidato_id');
            $table->foreign('candidato_id')->references('id_cand')->on('candidatos');
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
        Schema::dropIfExists('grupo_familiar_receitas');
    }
}
