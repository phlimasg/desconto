<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFiliacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filiacaos', function (Blueprint $table) {
            $table->bigInteger('candidato_id_cand');
            $table->string('nome_t1');
            $table->string('cpf_t1');
            $table->string('rg_t1');
            $table->date('dtnasc_t1');
            $table->string('rd_t1');
            $table->string('nome_t2')->nullable();
            $table->string('cpf_t2')->nullable();
            $table->string('rg_t2')->nullable();
            $table->date('dtnasc_t2')->nullable();
            $table->string('rd_t2')->nullable();
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
        Schema::dropIfExists('filiacaos');
    }
}
