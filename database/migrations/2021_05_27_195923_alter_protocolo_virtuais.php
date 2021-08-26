<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProtocoloVirtuais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocolo_virtuais', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->unsignedBigInteger('status_id')->default(1);

            $table->foreign('status_id')->references('id')->on('tipo_licencas');

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
            $table->smallInteger('status');
            $table->dropForeign('protocolo_virtuais_status_id_foreign');
            $table->dropColumn('status_id');
        });
    }
}
