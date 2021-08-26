<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusIdAtendimento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('atendimento_virtuais', function (Blueprint $table) {
            $table->unsignedBigInteger('status_atendimento_id')->default(1);
            $table->foreign('status_atendimento_id')->references('id')->on('status_atendimento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('atendimento_virtuais', function (Blueprint $table) {
            $table->dropForeign(['status_atendimento_id']);
            $table->dropColumn('status_atendimento_id');
        });
    }
}
