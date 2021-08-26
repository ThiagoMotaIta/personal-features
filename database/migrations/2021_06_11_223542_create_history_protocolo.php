<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryProtocolo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_protocolo', function (Blueprint $table) {    

            $table->id();
            $table->unsignedBigInteger('document_id');
            $table->unsignedBigInteger('protocolo_id');
            $table->unsignedBigInteger('user_id');
            $table->smallInteger('approved_document');
            $table->smallInteger('approved_procotolo');

            $table->timestamps();

            $table->foreign('document_id')->references('id')->on('documents');
            $table->foreign('protocolo_id')->references('id')->on('protocolo_virtuais');
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
        //   Schema::table('historico_protocolo', function (Blueprint $table) {
        //     $table->dropColumn('document_id');
        //     $table->dropColumn('protocolo_id');
        //     $table->dropColumn('user_id');
        //     $table->dropColumn('approved');           
        // });

        Schema::dropIfExists('historico_protocolo');

    }
}
