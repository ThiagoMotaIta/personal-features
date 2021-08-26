<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProtocoloVirtuaisAddEModificandoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('protocolo_virtuais', function (Blueprint $table) {
            $table->string('cnpj', 60)->nullable()->change();
            $table->string('razao_social', 150)->nullable()->change();
            $table->string('requerente', 100)->default('0')->change();
            $table->string('cpf', 60)->nullable()->change();
            $table->string('empreendimento', 100)->nullable()->change();
            $table->smallInteger('status')->default(1);
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
            $table->string('cnpj', 60)->change();
            $table->string('razao_social', 150)->change();
            $table->string('requerente', 100)->change();
            $table->string('cpf', 60)->change();
            $table->string('empreendimento', 100)->change();
            $table->dropColumn('status');
        });
    }
}
