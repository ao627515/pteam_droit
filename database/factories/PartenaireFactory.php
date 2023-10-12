<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\CategoriePartenaire;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partenaire>
 */
class PartenaireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->name,
            'phone' => fake()->phoneNumber,
            'email' => fake()->unique()->safeEmail,
            'logo' => fake()->imageUrl(category: 'Logo partenaire'),
            'description' => fake()->text(),
            // 'active' => fake()->boolean,
            'categorie_partenaire_id' => function () {
                // Assurez-vous d'avoir des catégories de partenaires existantes dans la table "categorie_partenaires"
                return CategoriePartenaire::inRandomOrder()->first()->id;
            },
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'approuved_by' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'approuved_at' => fake()->dateTimeThisDecade,
            'lib_doc_1' => fake()->word,
            'lib_doc_2' => fake()->word,
            'lib_doc_3' => fake()->word,
            'lib_doc_4' => fake()->word,
            'val_doc_1' => fake()->word,
            'val_doc_2' => fake()->word,
            'val_doc_3' => fake()->word,
            'val_doc_4' => fake()->word,
            'created_at' => fake()->dateTimeThisDecade,
            'updated_at' => fake()->dateTimeThisDecade,
        ];
    }
}
