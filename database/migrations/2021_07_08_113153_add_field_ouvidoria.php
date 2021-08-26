<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldOuvidoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {    
        Schema::table('ouvidorias', function (Blueprint $table) {   
            $table->string('cpf')->after('nome');
            $table->dropUnique('ouvidorias_email_unique');
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
            $table->dropColumn('cpf');
            $table->unique('email');  
        });
    }
}
