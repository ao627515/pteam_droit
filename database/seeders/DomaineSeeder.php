<?php

namespace Database\Seeders;

use App\Models\Domaine;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DomaineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $domaines = [
            [
                'nom' => 'Droit civil',
                'description' => 'Spécialisé dans le droit civil',
            ],
            [
                'nom' => 'Droit pénal',
                'description' => 'Spécialisé dans le droit pénal',
            ],
            [
                'nom' => 'Droit commercial',
                'description' => 'Spécialisé dans le droit commercial',
            ],
            [
                'nom' => 'Droit de la famille',
                'description' => 'Spécialisé dans le droit de la famille',
            ],
            [
                'nom' => 'Droit des contrats',
                'description' => 'Spécialisé dans le droit des contrats',
            ],
        ];

        // Insertion des données dans la table "domaines"
        DB::table('domaines')->insert($domaines);
        Domaine::factory(10)->create();
    }
}
