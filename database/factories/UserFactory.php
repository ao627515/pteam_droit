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
        $type_compte = fake()->randomElement(['physique', 'morale', 'partenaire']);
        $bool = fake()->boolean(40);
        return [
            'nom' => fake()->lastName,
            'prenom' => fake()->firstName,
            'phone' => fake()->unique()->randomNumber(8, true),
            'email' => fake()->unique()->safeEmail,
            'password' => bcrypt('1234'), // Mot de passe par défaut
            'type_compte' => $type_compte,
            'active' => fake()->boolean,
            'remember_token' => Str::random(10),
            'role' => function () use ($type_compte, $bool){
                return $bool ? 'administrateur' : $type_compte == 'morale' or $type_compte == 'physique' ? 'utilisateur' : 'partenaire';
            },
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

}
