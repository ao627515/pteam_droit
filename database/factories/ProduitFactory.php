<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produit>
 */
class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->sentence,
            'short_desc' => fake()->text(100),
            'description' => fake()->text(200),
            'stock' => fake()->numberBetween(1, 100),
            'image' => fake()->imageUrl(category: 'Produit'), // Exemple d'URL d'image générée aléatoirement
            'author_id' => function () {
                return User::inRandomOrder()->first()->id; // Crée un utilisateur et utilise son ID
            },
            // 'active' => fake()->boolean,
        ];
    }
}
