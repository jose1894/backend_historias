<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergencia', function (Blueprint $table) {
            $table->increments("id")->comment('ID UNICO');
            $table->integer('persona_id')->unsigned()->nullable()->comment('REFERENCIA DE PERSONA EMPLEADO');
            $table->foreign('persona_id')
                  ->references('id')
                  ->on('persona')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');
            $table->enum("turno",['M', 'T', 'N'])->comment('M-MAÑANA','T-TARDE','N-NOCHE');
            $table->dateTime("fecha")->nullable()->comment('FECHA DE INGRESO');            
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
        Schema::dropIfExists('emergencia');
    }
}