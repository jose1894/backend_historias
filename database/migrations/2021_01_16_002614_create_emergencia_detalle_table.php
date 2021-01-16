<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergenciaDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergencia_detalle', function (Blueprint $table) {
            $table->increments("id")->comment('ID UNICO');
            $table->integer('emergencia_id')->unsigned()->comment('REFERENCIA DE EMERGENCIA');
            $table->foreign('emergencia_id')
                  ->references('id')
                  ->on('emergencia')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');
            $table->integer('paciente_id')->unsigned()->nullable()->comment('REFERENCIA DE PERSONA PACIENTE');
            $table->foreign('paciente_id')
                  ->references('id')
                  ->on('persona')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');
            $table->integer('motivoing_id')->unsigned()->nullable()->comment('REFERENCIA DE MOTIVO DE INGRESO');
            $table->foreign('motivoing_id')
                  ->references('id')
                  ->on('motivo_ingreso')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');
            $table->integer('diagnostico_id')->unsigned()->nullable()->comment('REFERENCIA DE DIAGNOSTICO');            
            $table->foreign('diagnostico_id')
                  ->references('id')
                  ->on('diagnostico')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');
            $table->text('observaciones')->comment('OBSERVACIONES DE LA EMERGENCIA');
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
        Schema::dropIfExists('emergencia_detalle');
    }
}
