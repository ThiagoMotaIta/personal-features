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
        // Create Author 1
        User::create([
            'name' => 'Thiago Mota',
            'email' => 'thiagomotaita1@gmail.com',
            'password' => bcrypt('qwer1234'),
        ]);

        // Create Author 2
        User::create([
            'name' => 'Marcos Magalhaes',
            'email' => 'marcos@investidor10.com.br',
            'password' => bcrypt('qwer1234'),
        ]);
    }
}
