<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdicionarCamposEmUsersMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ((!Schema::hasColumn('users', 'cpf_cnpj')) && (!Schema::hasColumn('users', 'tipo'))) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('cpf_cnpj')->after('id')->unique();
                $table->tinyInteger('tipo')->after('password');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        if (Schema::hasColumn('users', 'cpf_cnpj') && Schema::hasColumn('users', 'tipo')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('cpf_cnpj');
                $table->dropColumn('tipo');
            });
        }
       
    }
}
