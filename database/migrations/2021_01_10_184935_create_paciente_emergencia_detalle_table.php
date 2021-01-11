<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacienteEmergenciaDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paciente_emergencia_detalle', function (Blueprint $table) {
            $table->increments("id");
            $table->integer('paciente_emergencia_id')
                  ->unsigned()->nullable();
            $table->foreign('paciente_emergencia_id')
                  ->references('id')
                  ->on('paciente_emergencia')
                  ->onDelete('set null')
                  ->onUpdate('set null');
            $table->integer('persona_id')
                  ->unsigned()->nullable();
            $table->foreign('persona_id')
                  ->references('id')
                  ->on('persona')
                  ->onDelete('set null')
                  ->onUpdate('set null');
            $table->string("motivo_ingreso")->comment('MOTIVO DE INGRESO, HALLAZGOS CLINICOS');
            $table->string("impresion_diagnostica")->comment('IMPRESION DIAGNOSTICA');
            $table->string("dest",200)->comment('DEST');
            $table->string("observaciones")->comment('OBSERVCIONES');
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
        Schema::dropIfExists('paciente_emergencia_detalle');
    }
}
