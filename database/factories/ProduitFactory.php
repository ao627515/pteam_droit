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
        $declined = fake()->randomNumber() % 2 != 0 ? true : false;
        $author = User::where('role', 'administrator')->orWhere('role', 'partenaire')->get();
        return [
            'nom' => fake()->sentence,
            'short_desc' => fake()->text(100),
            'description' => fake()->text(200),
            'stock' => fake()->numberBetween(1, 100),
            'image' => fake()->imageUrl(category: 'Produit'), // Exemple d'URL d'image générée aléatoirement
            'author_id' => $author->random()->id,
            'active' => fake()->boolean,
            'approuved_at' => fn() => $approuve == true ? fake()->dateTimeThisDecade : null,
            'approuved_by' => fn() => $approuve == true ? User::inRandomOrder()->first()->id : null,
            'declined_at' => function () use ($declined) {
                return $declined == false ? fake()->dateTimeThisDecade : null;
            },

            'declined_by' => function () use ($declined){
                return $declined == false ? User::inRandomOrder()->first()->id : null;
            },
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
