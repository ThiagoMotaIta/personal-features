<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AssuntoSeeder extends Seeder
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

        DB::table('assuntos')->truncate();

        $data = [
            ['descricao' => 'DENÚNCIA', 'created_at' => new Carbon()],
            ['descricao' => 'ELOGIO', 'created_at' => new Carbon()],
            ['descricao' => 'INFORMAÇÃO', 'created_at' => new Carbon()],
            ['descricao' => 'OUTROS', 'created_at' => new Carbon()],
            ['descricao' => 'RECLAMAÇÃO', 'created_at' => new Carbon()],
            ['descricao' => 'SUGESTÃO', 'created_at' => new Carbon()],
        ];


        DB::table('assuntos')->insert($data);

        // supposed to only apply to a single connection and reset it's self
		// but I like to explicitly undo what I've done for clarity
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
