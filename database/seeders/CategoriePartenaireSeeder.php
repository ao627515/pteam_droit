<?php

namespace Database\Seeders;

use App\Models\CategoriePartenaire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriePartenaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoriePartenaire::factory(10)->create();
    }
}
