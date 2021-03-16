<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotivoDiagnosticoEmergenciaDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emergencia_detalle', function (Blueprint $table) {
            $table->text('motivoingreso')->nullable()->comment('OBSERVACIONES DEL MOTIVOINGRESO')->after('motivoing_id');
            $table->text('dignostico')->nullable()->comment('OBSERVACIONES DEL DIAGNOSTICO')->after('diagnostico_id');
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
            $table->dropColumn('motivoingreso');
            $table->dropColumn('dignostico');
        });
    }
}
