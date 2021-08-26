<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorarioSeeder extends Seeder
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

        DB::table('horarios')->truncate();

        $data = [
            ['user_id' => 1, 'setor_id' => 1, 'data' => date('2021-06-30'), 'horario' => "20:00:00" ],
        ];


        DB::table('horarios')->insert($data);

        // supposed to only apply to a single connection and reset it's self
		// but I like to explicitly undo what I've done for clarity
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
