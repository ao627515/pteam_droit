<?php

namespace Database\Seeders;

use App\Models\categorie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Actualités juridiques',
            'Formation juridique',
            'Ressources juridiques',
            'Conseils juridiques',
            'Technologie juridique',
            'Formation en médiation',
            'Accessoires de bureau',
            'Vêtements et accessoires juridiques',
            'Services en ligne',
            'Conformité réglementaire',
        ];

        foreach ($categories as $categorie) {
            categorie::factory()->create([
                'nom' => $categorie
            ]);
        }
    }
}
