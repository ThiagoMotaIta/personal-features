<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnonymousOuvidoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ouvidorias', function (Blueprint $table) {
            $table->string('nome')->nullable()->change();
            $table->string('cpf')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ouvidorias', function (Blueprint $table) {
            $table->string('nome')->change();
            $table->string('cpf')->change();
        });
    }
}
