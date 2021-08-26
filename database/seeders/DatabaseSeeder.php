<?php

namespace Database\Seeders;

use App\Models\Assunto;
use App\Models\Status;
use Illuminate\Database\Seeder;
use Database\Seeders\TipoLicencaSeeder;
use Database\Seeders\StatusProtocoloSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(TipoLicencaSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(StatusProtocoloSeeder::class);
        $this->call(StatusOuvidoriaSeeder::class);
        $this->call(SetorSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(AssuntoSeeder::class);
        $this->call(StatusAtendimentoSeeder::class);
        // $this->call(DocumentsSeeder::class); // não descomentar, pois não está 100%
    }
}
