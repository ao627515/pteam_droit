<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Domaine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organisation>
 */
class OrganisationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->company,
            'phone' => fake()->phoneNumber,
            'email' => fake()->unique()->safeEmail,
            'logo' => fake()->imageUrl(category:'Organisation'),
            'description' => fake()->text(200),
            'short_description' => fake()->sentence,
            // 'active' => fake()->boolean,
            'user_id' => function () {
                return User::where('type_compte', 'morale')->orWhere('role', 'partenaire')->inRandomOrder()->first()->id;
            },
            'approuved_by' => null, // Vous pouvez définir l'ID de l'utilisateur qui approuve ici
            'approuved_at' => now(),
            'lib_doc_1' => 'RCCM',
            'lib_doc_2' => 'DOC2',
            'lib_doc_3' => fake()->word,
            'lib_doc_4' => fake()->word,
            'val_doc_1' => fake()->word,
            'val_doc_2' => fake()->word,
            'val_doc_3' => fake()->word,
            'val_doc_4' => fake()->word,
            'domaine_id' => Domaine::inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
