<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescontoAutorizadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desconto_autorizados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('valor_aut');
            $table->string('usuario_aut');
            $table->integer('candidato_id_cand');
            //$table->foreign('candidato_id_cand')->references('id_cand')->on('candidatos');
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
        Schema::dropIfExists('desconto_autorizados');
    }
}
