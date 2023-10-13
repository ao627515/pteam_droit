<?php

namespace Database\Seeders;

use App\Models\CategorieArticle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategorieArticle::factory()->create([
            'nom' => 'Droit du travail'
        ]);

        CategorieArticle::factory()->create([
            'nom' => 'Droit du commerce'
        ]);

        CategorieArticle::factory()->create([
            'nom' => 'Droit civil'
        ]);

        CategorieArticle::factory()->create([
            'nom' => 'Droit pénal'
        ]);
    }
}
