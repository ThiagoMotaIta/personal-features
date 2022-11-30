<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Category 1
        Category::create([
            'category' => 'Esportes',
        ]);
        // Create Category 2
        Category::create([
            'category' => 'Tecnologia',
        ]);
        // Create Category 3
        Category::create([
            'category' => 'Economia',
        ]);
    }
}
