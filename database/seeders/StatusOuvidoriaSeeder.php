<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatusOuvidoriaSeeder extends Seeder
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

        DB::table('status_ouvidorias')->truncate();

        $data = [
            ['descricao' => 'EM ABERTO', 'created_at' => new Carbon()],
            ['descricao' => 'CONCLUÍDO', 'created_at' => new Carbon()],
        ];


        DB::table('status_ouvidorias')->insert($data);

        // supposed to only apply to a single connection and reset it's self
		// but I like to explicitly undo what I've done for clarity
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
