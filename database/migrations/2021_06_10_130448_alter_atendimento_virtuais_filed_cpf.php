<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAtendimentoVirtuaisFiledCpf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('atendimento_virtuais', function (Blueprint $table) {
            $table->dropUnique('atendimento_virtuais_cpf_unique');
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
            $table->unique('cpf');
        });
    }
}
