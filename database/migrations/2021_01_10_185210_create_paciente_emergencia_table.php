<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacienteEmergenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paciente_emergencia', function (Blueprint $table) {
            $table->increments("id");
            $table->integer('persona_id')
                  ->unsigned()->nullable();
            $table->foreign('persona_id')
                  ->references('id')
                  ->on('persona')
                  ->onDelete('set null')
                  ->onUpdate('set null');
            $table->enum("turno",['M', 'T', 'N'])->comment('M-MAÑANA','T-TARDE','N-NOCHE');
            $table->date("fecha")->comment('FECHA DE INGRESO');
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
        Schema::dropIfExists('paciente_emergencia');
    }
}
