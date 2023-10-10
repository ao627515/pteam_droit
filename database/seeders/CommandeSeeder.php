<?php

namespace Database\Seeders;

use App\Models\Commande;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Commande::factory(10)->create();
    }
}
