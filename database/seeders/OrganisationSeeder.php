<?php

namespace Database\Seeders;

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
        DB::table('organisations')->insert([
            [
                'nom' => 'Organisation 1',
                'phone' => '123-456-7890',
                'email' => 'org1@example.com',
                'logo' => 'logo1.jpg',
                'description' => 'Description de l\'organisation 1',
                'short_description' => 'Courte description 1',
                'active' => 1,
                'user_id' => 1, // ID de l'utilisateur associé
                'approuved_by' => 2, // ID de l'utilisateur qui a approuvé
                'approuved_at' => now(),
                'lib_doc_1' => 'Document 1',
                'lib_doc_2' => 'Document 2',
                'lib_doc_3' => 'Document 3',
                'lib_doc_4' => 'Document 4',
                'val_doc_1' => 'Valeur 1',
                'val_doc_2' => 'Valeur 2',
                'val_doc_3' => 'Valeur 3',
                'val_doc_4' => 'Valeur 4',
                'domaine_id' => 1, // ID du domaine associé
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Organisation 2',
                'phone' => '987-654-3210',
                'email' => 'org2@example.com',
                'logo' => 'logo2.jpg',
                'description' => 'Description de l\'organisation 2',
                'short_description' => 'Courte description 2',
                'active' => 1,
                'user_id' => 3, // ID de l'utilisateur associé
                'approuved_by' => 4, // ID de l'utilisateur qui a approuvé
                'approuved_at' => now(),
                'lib_doc_1' => 'Document 5',
                'lib_doc_2' => 'Document 6',
                'lib_doc_3' => 'Document 7',
                'lib_doc_4' => 'Document 8',
                'val_doc_1' => 'Valeur 5',
                'val_doc_2' => 'Valeur 6',
                'val_doc_3' => 'Valeur 7',
                'val_doc_4' => 'Valeur 8',
                'domaine_id' => 2, // ID du domaine associé
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Ajoutez d'autres enregistrements existants ici si nécessaire

        ]);

        Organisation::factory(10)->create();

    }
}
