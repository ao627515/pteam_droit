<?php

namespace Database\Seeders;

use App\Models\Domaine;
use App\Models\Organisation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrganisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organisation::factory()->create([

                'nom' => 'Organisation 1',
                'phone' => '123-456-7890',
                'email' => 'org1@example.com',
                'logo' => 'logo1.jpg',
                'description' => 'Description de l\'organisation 1',
                'short_description' => 'Courte description 1',
                'active' => 1,
                'user_id' => 2, // ID de l'utilisateur associé
                'approuved_by' => 1, // ID de l'utilisateur qui a approuvé
                'approuved_at' => now(),
                'lib_doc_1' => 'RCCM',
                'lib_doc_2' => 'Document 2',
                'lib_doc_3' => 'Document 3',
                'lib_doc_4' => 'Document 4',
                'val_doc_1' => 'uploads/docs/u_74rccm_653949dd50f51.pdf',
                'val_doc_2' => 'Valeur 2',
                'val_doc_3' => 'Valeur 3',
                'val_doc_4' => 'Valeur 4',
                'domaine_id' => Domaine::inRandomOrder()->first()->id,
                'created_at' => now(),
                'updated_at' => now(),
            
        ]);

        Organisation::factory(49)->create();

    }
}
