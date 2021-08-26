<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProtocoloVirtuaisAddCampo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocolo_virtuais', function (Blueprint $table) {
            $table->string('complemento', 100)->nullable();
            $table->string('requerente', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('protocolo_virtuais', function (Blueprint $table) {
            $table->dropColumn('complemento');
            $table->dropColumn('requerente');
        });
    }
}
