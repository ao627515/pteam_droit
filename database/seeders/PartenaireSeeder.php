<?php

namespace Database\Seeders;

use App\Models\Partenaire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartenaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Partenaire::factory(10)->create();
    }
}
