<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('parent_id');
            $table->string('path');
            $table->string('title');
            $table->timestamps();
        });
        $permission = [];
        $permission = [['id' => 1, 'parent_id' => 'null' , 'path' => '{"remove":false,"edit":false,"create":false,"list":false,"tag":"usuarios"}', 'title' => 'usuarios', 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],     
        ['id' => 2, 'parent_id' => 'null', 'path' => '{"remove":false,"edit":false,"create":false,"list":false,"tag":"licenciar"}', 'title' => 'licenciar', 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')]];            

        for ($i=0; $i < count($permission) ; $i++) { 
            DB::table('permissions')->insert($permission[$i]);
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
