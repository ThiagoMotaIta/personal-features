<?php

namespace Database\Seeders;

use App\Models\TipoLicenca;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoLicencaSeeder extends Seeder
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

        DB::table('tipo_licencas')->truncate();

        $data = [
            ['id' => 1, 'descricao' => 'LICENÇA PARA EVENTO'],
            ['id' => 2, 'descricao' => 'LICENÇA DE PUBLICIDADE'],
            ['id' => 3, 'descricao' => 'ALVARÁ DE FUNCIONAMENTO'],
            ['id' => 4, 'descricao' => 'ALVARÁ DE FUNCIONAMENTO - RENOVAÇÃO'],
            ['id' => 5, 'descricao' => 'CARTA DE ANUÊNCIA PARA PARCELAMENTO DE SOLO'],
            ['id' => 6, 'descricao' => 'LICENÇA PARA DESMEMBRAMENTO/REMEMBRAMENTO'],
            ['id' => 7, 'descricao' => 'APROVAÇÃO DE PROJETO DE LOTEAMENTO (ALVARÁ)'],
            ['id' => 8, 'descricao' => 'APROVO DEFINITIVO DE LOTEAMENTO'],
            ['id' => 9, 'descricao' => 'CERTIDÃO IMOBILIÁRIA'],
            ['id' => 10, 'descricao' => 'CONSULTA DE VIABILIDADE LOCACIONAL '],
            ['id' => 12, 'descricao' => 'ALVARÁ DE DEMOLIÇÃO'],
            ['id' => 13, 'descricao' => 'ALVARÁ DE CONSTRUÇÃO'],
            ['id' => 14, 'descricao' => 'ALVARÁ DE CONSTRUÇÃO - RENOVAÇÃO'],
            ['id' => 15, 'descricao' => 'ALVARÁ DE CONSTRUÇÃO PARA EQUIPAMENTO DE TELECOMUNICAÇÃO (ANTENA)'],
            ['id' => 16, 'descricao' => 'ALVARÁ DE REPAROS GERAIS'],
            ['id' => 17, 'descricao' => 'SOLICITAÇÃO GERAL'],
            ['id' => 18, 'descricao' => 'DEFESA'],            
            ['id' => 19, 'descricao' => 'AUTORIZAÇÃO AMBIENTAL - DIVERSAS'],            
            ['id' => 20, 'descricao' => 'AUTORIZAÇÃO AMBIENTAL - INTERVENÇÃO EM APP'],            
            ['id' => 21, 'descricao' => 'AUTORIZAÇÃO AMBIENTAL - SUPRESSÃO VEGETAL'],            
            ['id' => 22, 'descricao' => 'AUTORIZAÇÃO AMBIENTAL - MANEJO DE FAUNA SILVESTRE'],            
            ['id' => 23, 'descricao' => 'AUTORIZAÇÃO AMBIENTAL - TRANSPORTE DE RESÍDUOS'],            
            ['id' => 24, 'descricao' => 'LICENÇA PRÉVIA - PARCELAMENTO DO SOLO'],            
            ['id' => 25, 'descricao' => 'LICENÇA DE INSTALAÇÃO - PARCELAMENTO DO SOLO'], 
            ['id' => 26, 'descricao' => 'LICENÇA PRÉVIA - CONSTRUÇÃO'],   
            ['id' => 27, 'descricao' => 'LICENÇA DE INSTALAÇÃO - CONSTRUÇÃO'],    
            ['id' => 28, 'descricao' => 'LICENÇA DE INSTALAÇÃO - LINHA DE TRANSMISSÃO'], 
            ['id' => 29, 'descricao' => 'LICENÇA DE OPERAÇÃO'],     
            ['id' => 30, 'descricao' => 'LICENÇA MINERAL'],    
            ['id' => 31, 'descricao' => 'LICENÇA DE OPERAÇÃO PARA EXTRAÇÃO MINERAL'], 
            ['id' => 32, 'descricao' => 'LICENÇA POR ADESÃO E COMPROMISSO - AGRICULTURA FAMILIAR'],  
            ['id' => 33, 'descricao' => 'LICENÇA POR ADESÃO E COMPROMISSO - ERB'],  
            ['id' => 34, 'descricao' => 'CADASTRO TÉCNICO - CONSULTOR INDIVIDUAL'],            
            ['id' => 35, 'descricao' => 'CADASTRO TÉCNICO - EMPRESA DE CONSULTORIA AMBIENTAL'],   
            // ['id' => 36, 'descricao' => 'SOLICITAÇÃO GERAL'],
            // ['id' => 37, 'descricao' => 'DEFESA'],    
            ['id' => 38, 'descricao' => 'CARTA DE ANUÊNCIA PARA ATIVIDADE ESPECIAL OU EQUIPAMENTO INSITUCIONAL'],
            ['id' => 39, 'descricao' => 'HABITE-SE'],
            ['id' => 40, 'descricao' => 'ALTERAÇÃO DE PROJETO'],
            ['id' => 41, 'descricao' => 'AUTORIZAÇÃO PARA INSTALAÇÃO TEMPORÁRIA'],
            ['id' => 42, 'descricao' => 'ALVARÁ DE CONSTRUÇÃO SOCIAL'],
            ['id' => 43, 'descricao' => 'SOLICITAÇÃO DE REGULARIZAÇÃO FUNDIÁRIA']
            
                                               
        ];



        DB::table('tipo_licencas')->insert($data);

        // supposed to only apply to a single connection and reset it's self
		// but I like to explicitly undo what I've done for clarity
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
