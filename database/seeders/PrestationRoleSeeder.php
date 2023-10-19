<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Prestation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PrestationRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partenaires = User::where('active', true)->where('role', 'partenaire')->get();

        foreach($partenaires as $partenaire){

            for($i = 0; $i < fake()->numberBetween(1, 6); $i++){
                DB::table('prestation_user')->insert([
                    'user_id' => $partenaire->id,
                    'prestation_id' => Prestation::inRandomOrder()->first()->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
