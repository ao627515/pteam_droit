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
        $approuve = fake()->randomNumber() % 2 != 0 ? true : false;
        return [
            'titre' => $title,
            'description' => fake()->text,
            'contenu' => fake()->paragraphs(100, true),
            'slug' => Str::slug($title),
            'image' => fake()->imageUrl(category: 'Article'),
            'author_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'active' => fake()->boolean,
            'categorie_article_id' => CategorieArticle::inRandomOrder()->first()->id,
            // 'approuved_at' => fake()->dateTimeThisDecade,
            // 'approuved_by' => function () {
            //     return User::inRandomOrder()->first()->id;
            // },

            'approuved_at' => function () use ($approuve) {
                return $approuve == false ? fake()->dateTimeThisDecade : null;
            },

            'approuved_by' => function () use ($approuve){
                return $approuve == false ? User::inRandomOrder()->first()->id : null;
            },
        ];
    }
}
