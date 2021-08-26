<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoLicencasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_licencas', function (Blueprint $table) {
            $table->id();
            $table->string('descricao', 255);
            $table->timestamps();
        });
        
        $data = [
            ['descricao' => 'Tipo 1'],
            ['descricao' => 'Tipo 2'],
            ['descricao' => 'Tipo 3'],
            ['descricao' => 'Tipo 4'],
        ];

        DB::table('tipo_licencas')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_licencas');
    }
}
