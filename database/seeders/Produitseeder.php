<?php

namespace Database\Seeders;


use App\Models\Produit;
use Illuminate\Database\Seeder;



class Produitseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Produit::factory(400)->create();
    }
}
