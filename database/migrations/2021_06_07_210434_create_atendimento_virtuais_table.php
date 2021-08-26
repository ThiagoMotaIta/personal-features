<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtendimentoVirtuaisTable extends Migration
{
        /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atendimento_virtuais', function (Blueprint $table) {
            $table->id();
            $table->string('cpf', 255)->unique();
            $table->string('nome', 255);
            $table->string('telefone', 255);
            $table->string('email', 255);
            $table->string('numero_processo', 255)->nullable();
            $table->string('assunto', 255);
            $table->unsignedBigInteger('setor_id');
            $table->dateTime('data_atendimento');
            $table->longText('mensagem');
            $table->timestamps();

            $table->foreign('setor_id')->references('id')->on('setores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atendimento_virtuais');
    }
}
