<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paciente', function (Blueprint $table) {
            $table->increments("id");
            $table->enum("tipo_id",['V', 'E', 'P'])->comment('V-VENEZOLANO','E-EXTRANJERO','P-PASAPORTE');
            $table->string("identificacion",10)->comment('NUMERO DE IDENTIFICACION');
            $table->string("nombres",50)->comment('NOMBRES DEL PACIENTE');
            $table->string("apellidos",50)->comment('APELLIDOS DEL PACIENTE');
            $table->enum("sexo",['M', 'F'])->comment('SEXO DEL PACIENTE');
            $table->string("email",255)->comment('CORREO ELECTRONICO');
            $table->date("fecha_nac")->comment('FECHA DE NACIMIENTO DEL PACIENTE');
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
        Schema::dropIfExists('paciente');
    }
}
