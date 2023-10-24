<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $approuve = fake()->randomNumber() % 2 != 0 ? true : false;
        $declined = !$approuve;
        $nullish = fake()->randomNumber() % 2 != 0 ? true : false;
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
            'status' => function () use ($approuve, $nullish) {
                return $nullish == true ? 1 : ($approuve == true ? 2 : 3);
            },
            'created_at' => now(),
            'updated_at' => now(),
            'approuved_at' => function () use ($approuve, $nullish) {
                return $nullish == true ? null : ($approuve == true ? now() : null);
            },

            'approuved_by' => function () use ($approuve, $nullish){
                return $nullish == true ? null : ($approuve == true ? 1 : null);
            },

            'declined_at' => function () use ($declined, $nullish) {
                return $nullish == true ? null : ($declined == true ? now() : null);
            },

            'declined_by' => function () use ($declined, $nullish){
                return $nullish == true ? null  : ($declined == true ?  1 : null);
            },
        ];
    }

}
