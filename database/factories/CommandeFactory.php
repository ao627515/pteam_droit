<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Produit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commande>
 */
class CommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stock = fake()->numberBetween(1, 100);
        return [
            'status' => fake()->randomElement([1]),
            // 'active' => fake()->boolean,
            'produit_id' => Produit::inRandomOrder()->first()->id, // Remplacez par l'ID du produit correspondant
            'user_id' => User::inRandomOrder()->first()->id, // Remplacez par l'ID de l'utilisateur correspondant
            'quantity' => fake()->numberBetween(1, $stock), // Quantité aléatoire entre 1 et 5
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
