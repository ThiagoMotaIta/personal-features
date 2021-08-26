<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProtocoloVirtuaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocolo_virtuais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('licenca', 2);
            $table->smallInteger('tipo_licenca');
            $table->string('empreendimento', 100);
            $table->string('cnpj', 60);
            $table->string('razao_social', 60);
            $table->string('cpf', 60);
            $table->string('cep', 60);
            $table->string('endereco', 100);
            $table->string('bairro', 60);
            $table->smallInteger('numero');
            $table->string('municipio', 60);
            $table->string('uf', 2);
            $table->string('telefone', 20);
            $table->string('email', 100);
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('protocolo_virtuais');
    }
}
