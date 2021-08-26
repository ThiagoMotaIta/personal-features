<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAprovacaoCargo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aprovacao_cargo', function (Blueprint $table) {
            $table->id();
            $table->string('cargo',200);
            $table->unsignedBigInteger('protocolo_id');
            $table->smallInteger('approved');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('aprovacao_cargo', function (Blueprint $table) {
        //     $table->dropColumn('cargo');;           
        // });

        Schema::dropIfExists('aprovacao_cargo');
    }
}
