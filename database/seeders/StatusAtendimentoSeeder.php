<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusAtendimentoSeeder extends Seeder
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

        DB::table('status_atendimento')->truncate();

        $data = [
            ['descricao' => 'Não respondido', 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ['descricao' => 'Respondido', 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
        ];


        DB::table('status_atendimento')->insert($data);

        // supposed to only apply to a single connection and reset it's self
		// but I like to explicitly undo what I've done for clarity
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
