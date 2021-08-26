<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //disable foreign key check for this connection before running seeders
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('permissions')->truncate();

        $data = [
            ['id' => 3, 'parent_id' => 'null' , 'path' => '{"remove":false,"edit":false,"create":false,"list":false,"tag":"usuarios","title":"Usuários"}', 'title' => 'Usuários', 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d') ],
            ['id' => 2, 'parent_id' => 'null' , 'path' => '{"remove":false,"edit":false,"create":false,"list":false,"tag":"permissoes","title":"Permissões"}', 'title' => 'Permissões', 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d') ],
            ['id' => 5, 'parent_id' => 'null' , 'path' => '{"remove":false,"edit":false,"create":false,"list":false,"tag":"horario","title":"Horários Atend. Virutal"}', 'title' => 'Horários Atend. Virutal', 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d') ],    
            ['id' => 4, 'parent_id' => 'null' , 'path' => '{"remove":false,"edit":false,"create":false,"list":false,"tag":"atendimento","title":"Atend. Virutal"}', 'title' => 'Atend. Virutal', 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d') ],    
            ['id' => 1, 'parent_id' => 'null' , 'path' => '{"remove":false,"edit":false,"create":false,"list":false,"tag":"processo","title":"Analisar Processo"}', 'title' => 'Analisar Processo', 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d') ],    
            ['id' => 7, 'parent_id' => 'null' , 'path' => '{"remove":false,"edit":false,"create":false,"list":false,"tag":"fale-conosco","title":"Fale Conosoco"}', 'title' => 'Fale Conosoco', 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d') ],    
            ['id' => 6, 'parent_id' => 'null' , 'path' => '{"remove":false,"edit":false,"create":false,"list":false,"tag":"relatorios","title":"Relatórios"}', 'title' => 'Relatórios', 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d') ],    
        ];           

        DB::table('permissions')->insert($data);

        // supposed to only apply to a single connection and reset it's self
		// but I like to explicitly undo what I've done for clarity
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}