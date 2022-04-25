<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Sailer 1
        User::create([
            'name' => 'Vendedor 1',
            'email' => 'vendedor1@vitaminaweb.com.br',
            'type' => 'V',
            'password' => bcrypt('qwer1234'),
        ]);

        // Create Sailer 2
        User::create([
            'name' => 'Vendedor 2',
            'email' => 'vendedor2@vitaminaweb.com.br',
            'type' => 'V',
            'password' => bcrypt('qwer1234'),
        ]);

        // Create client 1
        User::create([
            'name' => 'Cliente 1',
            'email' => 'cliente1@cliente1.com.br',
            'type' => 'C',
            'password' => bcrypt('qwer1234'),
        ]);

        // Create client 2
        User::create([
            'name' => 'Cliente 2',
            'email' => 'cliente2@cliente2.com.br',
            'type' => 'C',
            'password' => bcrypt('qwer1234'),
        ]);

        // Create client 3
        User::create([
            'name' => 'Cliente 3',
            'email' => 'cliente3@cliente3.com.br',
            'type' => 'C',
            'password' => bcrypt('qwer1234'),
        ]);
    }
}
