<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOuvidoriasRenameField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ouvidorias', function (Blueprint $table) {   
            $table->renameColumn('assunto', 'assunto_id');
        });

        Schema::table('ouvidorias', function (Blueprint $table) {   
            $table->unsignedBigInteger('assunto_id')->change();
            $table->foreign('assunto_id')->references('id')->on('assuntos');
        });

        // Schema::table('ouvidorias', function (Blueprint $table) {
        //     $table->foreign('assunto_id')->references('id')->on('assuntos');
        // });

        // Schema::table('ouvidorias', function (Blueprint $table) {   
        //     $table->renameColumn('assunto_id', 'assunto');
        // });

        // Schema::table('ouvidorias', function (Blueprint $table) {   
        //     $table->string('assunto')->change();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ouvidorias', function (Blueprint $table) {  
            $table->dropForeign('ouvidorias_assunto_id_foreign');
            $table->renameColumn('assunto_id', 'assunto');  
        });

        Schema::table('ouvidorias', function (Blueprint $table) {  
            $table->string('assunto')->change();
        });
    }
}
