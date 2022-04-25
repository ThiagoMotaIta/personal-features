<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oportunities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('id_product');
            $table->unsignedBigInteger('id_sailer');
            $table->unsignedBigInteger('id_client');
            $table->string('status', 1); // V for VENCIDA // P for PERDIDA
        });

        Schema::table('oportunities', function (Blueprint $table) {
            $table->foreign('id_product')->references('id')->on('products');
            $table->foreign('id_sailer')->references('id')->on('users');
            $table->foreign('id_client')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oportunities');
    }
};
