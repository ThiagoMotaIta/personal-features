<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusProtocolo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_protocolos', function (Blueprint $table) {
            $table->id();
            $table->string('descricao', 255);
            $table->timestamps();
        });

        $statusProtocolo = [];
        $statusProtocolo = [
            ['id' => '1', 'descricao' => 'Status 1', 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],     
        ];    
        
        for ($i=0; $i < count($statusProtocolo) ; $i++) { 
            DB::table('status_protocolos')->insert($statusProtocolo[$i]);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_protocolos');
    }
}
