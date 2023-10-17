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
            'Droit de la famille',
            'Droit du commerce',
            'Droit du civil',
            'autre',
            'Droit des contrats',
            'Droit des sociétés',
            'Droit du travail',
            'Droit immobilier',
            'Droit criminel',
            'Droit de la propriété intellectuelle',
            'Droit de l\'environnement',
            'Droit de la cyber-sécurité et de la vie privée',
            'Droit de la santé',
        ];

        foreach ($domaines as $domaine) {
            Domaine::factory()->create([
                'nom' => $domaine
            ]);
        }
    }
}
