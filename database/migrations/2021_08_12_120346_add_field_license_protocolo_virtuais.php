<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldLicenseProtocoloVirtuais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocolo_virtuais', function (Blueprint $table) {
            $table->string('license')->nullable();
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
            $table->dropColumn('license');
        });
    }
}
