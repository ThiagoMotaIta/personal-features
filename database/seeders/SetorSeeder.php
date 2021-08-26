<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SetorSeeder extends Seeder
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

        DB::table('setores')->truncate();

        $data = [
            ['nome' => 'ASSESSORIA JURÍDICA - ASJUR', 'created_at' => new Carbon()],
            ['nome' => 'COORDENADORIA ADMINISTRATIVA-FINANCEIRA - COAFI', 'created_at' => new Carbon()],
            ['nome' => 'COORDENADORIA DE FISCALIZAÇÃO - COFIS', 'created_at' => new Carbon()],
            ['nome' => 'COORDENADORIA DE INOVAÇÃO E MODERNIZAÇÃO - COINOV', 'created_at' => new Carbon()],
            ['nome' => 'COORDENADORIA DE LICENCIAMENTO URBANO - COLURB', 'created_at' => new Carbon()],
            ['nome' => 'COORDENADORIA DE PLANEJAMENTO URBANO - COPLAN', 'created_at' => new Carbon()],
            ['nome' => 'DIRETORIA DE HABITAÇÃO SOCIAL - DIHAS', 'created_at' => new Carbon()],
            ['nome' => 'DIRETORIA DE PLANEJAMENTO E LICENCIAMENTO URBANO - DIPLAN', 'created_at' => new Carbon()],
            ['nome' => 'GABINETE', 'created_at' => new Carbon()],
            ['nome' => 'GERÊNCIA ADMINISTRATIVA-FINANCEIRA - GEAFI', 'created_at' => new Carbon()],
            ['nome' => 'GERÊNCIA DE FISCALIZAÇÃO - GEFIS', 'created_at' => new Carbon()],
            ['nome' => 'GERÊNCIA DE GEOPROCESSAMENTO - GEGEO', 'created_at' => new Carbon()],
            ['nome' => 'GERÊNCIA DE LICENCIAMENTO PARA CONTRUÇÃO - GELIC', 'created_at' => new Carbon()],
            ['nome' => 'GERÊNCIA DE LICENCIAMENTO PARA FUNCIONAMENTO - GELIF', 'created_at' => new Carbon()],
            ['nome' => 'GERÊNCIA DE PESSOAS - GEPE', 'created_at' => new Carbon()],
            ['nome' => 'ÓRGÃO EXTERNO', 'created_at' => new Carbon()],
        ];


        DB::table('setores')->insert($data);

        // supposed to only apply to a single connection and reset it's self
		// but I like to explicitly undo what I've done for clarity
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
