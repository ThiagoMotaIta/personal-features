<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlteProtocoloVirtuaisAddField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocolo_virtuais', function (Blueprint $table) {
            $table->unsignedBigInteger('status_confirmacao_id')->default(0);

            $table->foreign('status_confirmacao_id')->references('id')->on('status_confirmacao');
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
            $table->dropForeign('protocolo_virtuais_status_confirmacao_id_foreign');
            $table->dropColumn('status_confirmacao_id')->default(0);
        });
    }
}
