<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergDetProcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emerg_det_proc', function (Blueprint $table) {
            $table->increments('id')->comment('ID UNICO');
            $table->integer('emerdetproc_id')->unsigned()->nullable()->comment('REFERENCIA A LA TABLA DETALLE DE EMERGENCIA');
            $table->foreign('emerdetproc_id')
                  ->references('id')
                  ->on('emergencia_detalle')
                  ->onDelete('CASCADE')
                  ->onUpdate('CASCADE');          
            $table->text('observaciones')->comment('OBSERVACIONES DEL PROCEDIMIENTO');  
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
        Schema::dropIfExists('emerg_det_proc');
    }
}
