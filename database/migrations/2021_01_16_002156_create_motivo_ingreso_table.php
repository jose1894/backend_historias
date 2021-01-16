<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotivoIngresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motivo_ingreso', function (Blueprint $table) {
            $table->increments('id')->comment('ID UNICO');
            $table->string('descripcion',255)->comment('DESCRIPCION MOTIVO DE INGRESO');
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
        Schema::dropIfExists('motivo_ingreso');
    }
}
