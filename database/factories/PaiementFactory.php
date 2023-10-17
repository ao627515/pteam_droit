<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paiement>
 */
class PaiementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function () {
                // Vous pouvez attribuer ici un utilisateur existant au hasard
                return User::inRandomOrder()->first()->id;
            },
            'montant' => fake()->numberBetween(1000, 100000),
            'methode' => fake()->randomElement(['Carte de crédit', 'PayPal', 'Virement bancaire']),
            'status' => fake()->randomElement(['En attente', 'Payé', 'Annulé']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
