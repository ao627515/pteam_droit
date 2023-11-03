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
        $approuve = fake()->randomNumber() % 2 != 0 ? true : false;
        $declined = !$approuve;
        $nullish = fake()->randomNumber() % 2 != 0 ? true : false;

        $author = User::where('role', 'administrator')->orWhere('role', 'partenaire')->get();
        return [
            'nom' => fake()->sentence,
            'short_desc' => fake()->text(100),
            'description' => fake()->text(200),
            'stock' => fake()->numberBetween(1, 100),
            'image' => fake()->imageUrl(category: 'Produit'), // Exemple d'URL d'image générée aléatoirement
            'author_id' => $author->random()->id,
            'active' => fake()->boolean,
            'stock' => fake()->numberBetween(1, 100),
            'prix' => fake()->numberBetween(500, 100000),
            'status' => function () use ($approuve, $nullish) {
                return $nullish == true ? 1 : ($approuve == true ? 2 : 3);
            },
            'approuved_at' => function () use ($approuve, $nullish) {
                return $nullish == true ? null : ($approuve == true ? fake()->dateTimeThisDecade : null);
            },

            'approuved_by' => function () use ($approuve, $nullish){
                return $nullish == true ? null : ($approuve == true ? User::inRandomOrder()->first()->id : null);
            },

            'declined_at' => function () use ($declined, $nullish) {
                return $nullish == true ? null : ($declined == true ? fake()->dateTimeThisDecade : null);
            },

            'declined_by' => function () use ($declined, $nullish){
                return $nullish == true ? null  : ($declined == true ? User::inRandomOrder()->first()->id : null);
            },
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
