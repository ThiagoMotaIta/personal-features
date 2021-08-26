<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProtocoloVirtuaisAddField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocolo_virtuais', function (Blueprint $table) {
            $table->unsignedBigInteger('status_protocolo_id')->nullable()->default(1);
            $table->foreign('status_protocolo_id')->references('id')->on('status_protocolos');

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
            $table->dropForeign('protocolo_virtuais_status_protocolo_id_foreign');
            $table->dropColumn('status_protocolo_id');
        });
    }
}
