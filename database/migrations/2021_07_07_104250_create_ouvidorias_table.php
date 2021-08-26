<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOuvidoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ouvidorias', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 150);
            $table->string('telefone', 30)->nullable();
            $table->string('email')->unique();
            $table->string('assunto');
            $table->longtext('mensagem');
            $table->unsignedBigInteger('status_id')->default(1);
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('status_ouvidorias');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ouvidorias');
    }
}
