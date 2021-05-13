<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnfermeraIdToEmergencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emergencia', function (Blueprint $table) {
            $table->integer('enfermera_id')->nullable()->comment('ENFERMERA ID')->after('turno');
                $table->foreign('persona_id')
                    ->references('id')
                    ->on('persona')
                    ->onDelete('CASCADE')
                    ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emergencia', function (Blueprint $table) {
            $table->dropColumn('enfermera_id');
        });
    }
}
