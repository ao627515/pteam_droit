<?php

namespace Database\Factories;

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
            'nom' => fake()->name(),
            'short_desc' => fake()->sentence(),
            'description' => fake()->paragraph(),  // Exemple: "Produit 1"
            'image' => fake()->image(),
            'type' => fake()->randomElement(['droit public','droit prive','droit international','droit specialise','droit social']), // Type fictif // URL d'une image fictive
            'author_id' =>fake()->numberBetween(1, 5), // Description courte fictive
            'approuved_at' =>fake()->dateTime(),
        ];
    }
}
