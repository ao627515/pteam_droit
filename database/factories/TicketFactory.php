<?php

namespace Database\Factories;

use App\Models\Organisation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'objet' => fake()->sentence,
            'message' => fake()->text,
            'type' => fake()->numberBetween(1, 3), // Vous pouvez ajuster les valeurs possibles
            'status' => fake()->numberBetween(1, 3), // Vous pouvez ajuster les valeurs possibles
            'user_id' => function () {
                return User::where('role', 'utilisateur')->inRandomOrder()->first()->id; // Crée un utilisateur et utilise son ID
            },
            'target_user_id' => function () {
                return Organisation::inRandomOrder()->first()->id; // Crée un utilisateur et utilise son ID
            },
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
