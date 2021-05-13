<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->increments("id");
            $table->enum("tipo_id",['V', 'E', 'P'])->comment('V-VENEZOLANO','E-EXTRANJERO','P-PASAPORTE');
            $table->string("identificacion",10)->unique()->comment('NUMERO DE IDENTIFICACION');
            $table->string("nombres",50)->comment('NOMBRES DE LA PERSONA');
            $table->string("apellidos",50)->comment('APELLIDOS DE LA PERSONA');
            $table->enum("sexo",['M', 'F'])->comment('SEXO DE LA PERSONA');
            $table->string("email",255)->comment('CORREO ELECTRONICO');
            $table->date("fecha_nac")->comment('FECHA DE NACIMIENTO DE LA PERSONA');
            $table->string('direccion', 500)->comment('DIRECCION DE LA PERSONA');
            $table->integer('especialidad_id')
                  ->unsigned()->nullable();
            $table->foreign('especialidad_id')
                  ->references('id')
                  ->on('especialidad')
                  ->onDelete('set null')
                  ->onUpdate('set null');
            $table->integer('area_id')
                  ->unsigned()->nullable();
            $table->foreign('area_id')
                  ->references('id')
                  ->on('area')
                  ->onDelete('set null')
                  ->onUpdate('set null');
            $table->integer('tipo_persona_id')
                  ->unsigned()->nullable();
            $table->foreign('tipo_persona_id')
                  ->references('id')
                  ->on('tipo_persona')
                  ->onDelete('set null')
                  ->onUpdate('set null');
            $table->string('talla')->nullable()->comment('TALLA DE LA PERSONA');
            $table->string('peso')->integer()->comment('PESO DE LA PERSONA');
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
        Schema::dropIfExists('persona');
    }
}
