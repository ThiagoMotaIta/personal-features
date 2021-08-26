<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnProtocoloVirtuais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocolo_virtuais', function (Blueprint $table) {
            $table->dropColumn('tipo_licenca');
            $table->unsignedBigInteger('tipo_licenca_id');

            $table->foreign('tipo_licenca_id')->references('id')->on('tipo_licencas');

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
            $table->smallInteger('tipo_licenca');
            $table->dropForeign('protocolo_virtuais_tipo_licenca_id_foreign');
            $table->dropColumn('tipo_licenca_id');
        });
    }
}
