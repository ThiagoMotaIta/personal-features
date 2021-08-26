<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachDocumenents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attach_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('protocolo_id'); 
            $table->unsignedBigInteger('documents_id');                
            $table->timestamps();
        });

        DB::statement("ALTER TABLE attach_documents ADD file MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attach_documents');
    }
}
