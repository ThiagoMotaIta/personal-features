<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
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

        DB::table('profile')->truncate();

        $data = [
            ['id' => 1, 'name' =>  'Presidente/Secretário' , 'permission' => '[{"tag":"processo","remove":"1","edit":"1","create":"1","list":"1","title":"Analisar Processos"},{"tag":"permissoes","remove":"1","edit":"1","create":"1","list":"1","title":"Permissões"},{"tag":"usuarios","remove":"1","edit":"1","create":"1","list":"1","title":"Usuários"},{"tag":"atendimento","remove":"1","edit":"1","create":"1","list":"1","title":"Atend. Virtual"},{"tag":"horario","remove":"1","edit":"1","create":"1","list":"1","title":"Horários Atend. Virtual"},{"tag":"relatorios","remove":"1","edit":"1","create":"1","list":"1","title":"Relatórios"},{"tag":"fale-conosco","remove":"1","edit":"1","create":"1","list":"1","title":"Fale Conosco"}]', 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['id' => 2, 'name' =>  'Gerente', 'permission' => '[{"tag":"processo","remove":"1","edit":"1","create":"1","list":"1","title":"Analisar Processos"},{"tag":"permissoes","remove":"1","edit":"1","create":"1","list":"1","title":"Permissões"},{"tag":"usuarios","remove":"1","edit":"1","create":"1","list":"1","title":"Usuários"},{"tag":"atendimento","remove":"1","edit":"1","create":"1","list":"1","title":"Atend. Virtual"},{"tag":"horario","remove":"1","edit":"1","create":"1","list":"1","title":"Horários Atend. Virtual"},{"tag":"relatorios","remove":"1","edit":"1","create":"1","list":"1","title":"Relatórios"},{"tag":"fale-conosco","remove":"1","edit":"1","create":"1","list":"1","title":"Fale Conosco"}]', 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['id' => 3, 'name' =>  'Analista', 'permission' => '[{"tag":"processo","remove":"1","edit":"1","create":"1","list":"0","title":"Analisar Processos"},{"tag":"permissoes","remove":"1","edit":"1","create":"1","list":"0","title":"Permissões"},{"tag":"usuarios","remove":"1","edit":"1","create":"1","list":"0","title":"Usuários"},{"tag":"atendimento","remove":"1","edit":"1","create":"1","list":"0","title":"Atend. Virtual"},{"tag":"horario","remove":"1","edit":"1","create":"1","list":"0","title":"Horários Atend. Virtual"},{"tag":"relatorios","remove":"1","edit":"1","create":"1","list":"0","title":"Relatórios"},{"tag":"fale-conosco","remove":"1","edit":"1","create":"1","list":"0","title":"Fale Conosco"}]', 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['id' => 4, 'name' =>  'Coordenador', 'permission' => '[{"tag":"processo","remove":"1","edit":"0","create":"1","list":"1","title":"Analisar Processos"},{"tag":"permissoes","remove":"1","edit":"0","create":"1","list":"1","title":"Permissões"},{"tag":"usuarios","remove":"1","edit":"0","create":"1","list":"1","title":"Usuários"},{"tag":"atendimento","remove":"1","edit":"0","create":"1","list":"1","title":"Atend. Virtual"},{"tag":"horario","remove":"1","edit":"0","create":"1","list":"1","title":"Horários Atend. Virtual"},{"tag":"relatorios","remove":"1","edit":"0","create":"1","list":"1","title":"Relatórios"},{"tag":"fale-conosco","remove":"1","edit":"0","create":"1","list":"1","title":"Fale Conosco"}]', 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['id' => 5, 'name' =>  'Diretor' , 'permission' => '[{"tag":"processo","remove":"0","edit":"0","create":"0","list":"1","title":"Analisar Processos"},{"tag":"permissoes","remove":"0","edit":"0","create":"0","list":"1","title":"Permissões"},{"tag":"usuarios","remove":"0","edit":"0","create":"0","list":"1","title":"Usuários"},{"tag":"atendimento","remove":"0","edit":"0","create":"0","list":"1","title":"Atend. Virtual"},{"tag":"horario","remove":"0","edit":"0","create":"0","list":"1","title":"Horários Atend. Virtual"},{"tag":"relatorios","remove":"0","edit":"0","create":"0","list":"1","title":"Relatórios"},{"tag":"fale-conosco","remove":"0","edit":"0","create":"0","list":"1","title":"Fale Conosco"}]', 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')] ,
            ['id' => 6, 'name' =>  'Usuário' , 'permission' => '[{"tag":"processo","remove":"0","edit":"0","create":"0","list":"1","title":"Analisar Processos"},{"tag":"permissoes","remove":"0","edit":"0","create":"0","list":"1","title":"Permissões"},{"tag":"usuarios","remove":"0","edit":"0","create":"0","list":"1","title":"Usuários"},{"tag":"atendimento","remove":"0","edit":"0","create":"0","list":"1","title":"Atend. Virtual"},{"tag":"horario","remove":"0","edit":"0","create":"0","list":"1","title":"Horários Atend. Virtual"},{"tag":"relatorios","remove":"0","edit":"0","create":"0","list":"1","title":"Relatórios"},{"tag":"fale-conosco","remove":"0","edit":"0","create":"0","list":"1","title":"Fale Conosco"}]', 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')] ,
        ];


        DB::table('profile')->insert($data);

        // supposed to only apply to a single connection and reset it's self
		// but I like to explicitly undo what I've done for clarity
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
