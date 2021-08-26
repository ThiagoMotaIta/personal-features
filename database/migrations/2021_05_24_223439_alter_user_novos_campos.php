<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserNovosCampos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->after('email', function ($table) {
                $table->string('telefone', 20)->nullable();
                $table->string('cep', 20)->nullable();
                $table->string('endereco', 150)->nullable();
                $table->smallInteger('numero')->nullable();
                $table->string('complemento', 60)->nullable();
                $table->string('bairro', 60)->nullable();
                $table->string('cidade', 60)->nullable();
                $table->string('uf', 2)->nullable();
            });
            
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('telefone');
            $table->dropColumn('cep');
            $table->dropColumn('endereco');
            $table->dropColumn('numero');
            $table->dropColumn('complemento');
            $table->dropColumn('bairro');
            $table->dropColumn('cidade');
            $table->dropColumn('uf');
        });
    }
}
