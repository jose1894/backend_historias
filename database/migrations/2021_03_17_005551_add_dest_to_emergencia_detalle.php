<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDestToEmergenciaDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emergencia_detalle', function (Blueprint $table) {
            $table->text('dest')->nullable()->comment('DEST')->after('diagnostico');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emergencia_detalle', function (Blueprint $table) {
            $table->dropColumn('dest');
        });
    }
}
