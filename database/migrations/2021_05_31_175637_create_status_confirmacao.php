<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusConfirmacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_confirmacao', function (Blueprint $table) {
            DB::statement('SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";');
            $table->id();
            $table->string('descricao');            
            $table->timestamps();
        });

        $statusConfirmacao = [];
        $statusConfirmacao = [
            ['id' => '0', 'descricao' => 'Aguardando Confirmação', 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],     
            ['id' => '1', 'descricao' => 'Confirmação Aprovada', 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['id' => '2', 'descricao' => 'Confirmação Recusada', 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
        ];            

        for ($i=0; $i < count($statusConfirmacao) ; $i++) { 
            DB::table('status_confirmacao')->insert($statusConfirmacao[$i]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_confirmacao');
    }
}
