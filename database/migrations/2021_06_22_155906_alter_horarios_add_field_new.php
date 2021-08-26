<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterHorariosAddFieldNew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('horarios', function (Blueprint $table) {
            $table->renameColumn('horario', 'data');
            // $table->time('horario')->after('data');
        });

        Schema::table('horarios', function (Blueprint $table) {
            // $table->renameColumn('horario', 'data');
            $table->time('horario')->after('data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('horarios', function (Blueprint $table) {
            $table->dropColumn('horario');
            $table->renameColumn('data', 'horario');
        });
    }
}
