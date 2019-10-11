<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoFamiliarNewDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_familiar_new_documentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url_doc');
            $table->string('old_name_doc');
            $table->unsignedBigInteger('grupo_familiar_id');
            $table->foreign('grupo_familiar_id')->references('id')->on('grupo_familiar_news')->onDelete('cascade');
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
        Schema::dropIfExists('grupo_familiar_new_documentos');
    }
}
