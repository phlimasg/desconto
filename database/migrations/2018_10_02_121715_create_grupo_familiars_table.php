<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoFamiliarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_familiars', function (Blueprint $table) {
            $table->bigInteger('candidato_id_cand');
            $table->bigInteger('aluguel_desp')->nullable();
            $table->bigInteger('casa_desp');
            $table->bigInteger('cond_desp')->nullable();
            $table->bigInteger('cart_desp')->nullable();
            $table->bigInteger('pensao_desp')->nullable();
            $table->bigInteger('alug_receb_desp')->nullable();
            $table->bigInteger('renda_outros_desp')->nullable();
            $table->bigInteger('conv_desp')->nullable();
            $table->bigInteger('ensino_desp');
            $table->bigInteger('auto_fin_desp')->nullable();
            $table->bigInteger('imovel_fin_desp')->nullable();
            $table->bigInteger('despesas_outros_desp')->nullable();
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
        Schema::dropIfExists('grupo_familiars');
    }
}
