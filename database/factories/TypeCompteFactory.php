<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypeCompte>
 */
class TypeCompteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->word,
            'short_name' => fake()->word,
            'frais' => fake()->numberBetween(0, 50000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
