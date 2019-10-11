<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescontoSugeridosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desconto_sugeridos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('valor_desc');
            $table->string('usuario_desc');
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
        Schema::dropIfExists('desconto_sugeridos');
    }
}
