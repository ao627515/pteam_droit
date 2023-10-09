<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;



class Produitseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Produit::factory(100)->create();
    }
}
