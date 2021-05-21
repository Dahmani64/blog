<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'meta_description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'meta_keywords' => implode(',', $this->faker->words($nb = 3, $asText = false)),
            'excerpt' => $this->faker->paragraph($nbSentences = 4, $variableNbSentences = true),
            'body' => $this->faker->paragraphs($nb = 8, $asText = true),
            'active' => true,
        ];
    }
}
