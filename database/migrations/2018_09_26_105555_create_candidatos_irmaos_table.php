<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatosIrmaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidatos_irmaos', function (Blueprint $table) {
            $table->increments('id_ci');
            $table->string('mat_insc_ci');
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
        Schema::dropIfExists('candidatos_irmaos');
    }
}
