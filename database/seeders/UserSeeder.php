<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insérez d'abord les enregistrements existants
        DB::table('users')->insert([
            [
                'nom' => 'Ouedraogo',
                'prenom' => 'Abdoul Aziz',
                'phone' => '73471085',
                'email' => 'ao627515@gmail.com',
                'password' => Hash::make('1234'),
                'type_compte' => 'physique',
                'active' => 1,
                'role' => 'administrateur',
            ],
            [
                'nom' => 'Ouedraogo',
                'prenom' => 'Abdoul Aziz',
                'phone' => '74289890',
                'email' => 'abdo.ouedraogo.03@gmail.com',
                'password' => Hash::make('1234'),
                'type_compte' => 'physique',
                'active' => 1,
                'role' => 'partenaire',
            ],
            // Ajoutez d'autres enregistrements existants ici
        ]);

        // Générez ensuite des enregistrements à l'aide de la factory
        User::factory(200)->create();
    }
}
