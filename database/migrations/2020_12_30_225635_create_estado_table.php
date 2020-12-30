<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado', function (Blueprint $table) {
            $table->increments('id')->comment('ID ESTADO');
            $table->string('cod_edo',3)->unique()->comment('CODIGO ESTADO');
            $table->string('des_edo',30)->comment('DESCRIPCION DE ESTADO');
            $table->string('abrv_edo',4)->comment('ABREV. ESTADO');
            $table->integer('pais_edo')->unsigned();
            $table->foreign('pais_edo')->references('id')->on('pais');
            $table->integer('status_edo')->default(0)->comment('ESTATUS ESTADO');
            $table->timestamps();
            $table->engine = 'InnoDB';	
            $table->charset = 'utf8';	
            $table->collation = 'utf8_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estado');
    }
}
