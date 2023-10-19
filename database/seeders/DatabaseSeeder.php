<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ArticleSeeder;
use Database\Seeders\PartenaireSeeder;
use Database\Seeders\TypeCompteSeeder;
use Database\Seeders\OrganisationSeeder;
use Database\Seeders\PrestationRoleSeeder;
use Database\Seeders\CategorieArticleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TypeCompteSeeder::class,
            CategorieArticleSeeder::class,
            ArticleSeeder::class,
            DomaineSeeder::class,
            OrganisationSeeder::class,
            CategoriePartenaireSeeder::class,
            PartenaireSeeder::class,
            ProduitSeeder::class,
            TicketSeeder::class,
            CommandeSeeder::class,
            // CategorieProduitSeeder::class,
            FaqSeeder::class,
            PaiementSeeder::class,
            CategorieSeeder::class,
            PrestationSeeder::class,
            PrestationRoleSeeder::class,
        ]);
    }
}
