<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatoProtocolo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relato_protocolo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_id');
            $table->unsignedBigInteger('protocolo_id');
            $table->unsignedBigInteger('profile_id');
            $table->smallInteger('approved_document');
            $table->smallInteger('approved_procotolo');
            $table->string('note_document', 400)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('document_id')->references('id')->on('documents');
            $table->foreign('protocolo_id')->references('id')->on('protocolo_virtuais');
            $table->foreign('profile_id')->references('id')->on('profile');   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relato_protocolo');
    }
}
