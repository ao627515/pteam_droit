<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->lastName,
            'prenom' => fake()->firstName,
            'phone' => fake()->phoneNumber,
            'email' => fake()->unique()->safeEmail,
            'password' => bcrypt('1234'), // Mot de passe par défaut
            'type_compte' => fake()->randomElement(['physique', 'morale', 'partenaire']),
            'active' => fake()->boolean,
            'remember_token' => Str::random(10),
            'role' => fake()->randomElement(['administrateur', 'utilisateur', 'partenaire']),
        ];
    }

}
