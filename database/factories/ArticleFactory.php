<?php

namespace Database\Factories;

use App\Models\CategorieArticle;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence;
        $author = User::where('role', 'administrator')->orWhere('role', 'partenaire')->get();

        $approuve = fake()->randomNumber() % 2 != 0 ? true : false;
        $declined = !$approuve;
        $nullish = fake()->randomNumber() % 2 != 0 ? true : false;
        return [
            'titre' => $title,
            'description' => fake()->text,
            'contenu' => fake()->paragraphs(100, true),
            'slug' => Str::slug($title),
            'image' => fake()->imageUrl(category: 'Article'),
            'author_id' => $author->random()->id,
            'active' => fake()->boolean,
            'categorie_article_id' => CategorieArticle::inRandomOrder()->first()->id,
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
            'updated_at' => now()
        ];
    }
}
