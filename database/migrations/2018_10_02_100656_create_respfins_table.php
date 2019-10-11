<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespfinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respfins', function (Blueprint $table) {
            $table->bigInteger('candidato_id_cand');
            $table->string('nome_fin');
            $table->string('cpf_fin');
            $table->string('tel1_fin');
            $table->string('tel2_fin');
            $table->string('email_fin');
            $table->string('vinculo_fin');
            $table->string('just_fin')->nullable();
            $table->foreign('candidato_id_cand')->references('id_cand')->on('candidatos');
            $table->primary('candidato_id_cand');
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
        Schema::dropIfExists('respfins');
    }
}
