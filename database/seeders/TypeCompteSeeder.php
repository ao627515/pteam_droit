<?php

namespace Database\Seeders;

use App\Models\TypeCompte;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeCompteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insérez d'abord les enregistrements existants
         DB::table('type_comptes')->insert([
            [
                'nom' => 'Personne Physique',
                'short_name' => 'physique',
                'frais' => 1000,
            ],
            [
                'nom' => 'Personne Morale',
                'short_name' => 'morale',
                'frais' => 50000,
            ],
            [
                'nom' => 'Partenaire',
                'short_name' => 'partenaire',
                'frais' => 0,
            ],
        ]);

        // Générez ensuite des enregistrements à l'aide de la factory
        // TypeCompte::factory(10)->create();
    }
}
