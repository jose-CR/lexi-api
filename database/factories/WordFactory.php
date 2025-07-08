<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Word>
 */
class WordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $letter = $this->faker->randomLetter();

        $word = $this->faker->word();

        $definition = json_encode([
            $this->faker->word(),
            $this->faker->word(),
            $this->faker->word(),
        ]);

        $spanishSentence = $this->faker->sentence();

        $sentence = $this->faker->sentence();

        return [
            'letter' => $letter,
            'word' => $word,
            'definition' => $definition,
            'spanish_sentence' => $spanishSentence,
            'sentence' => $sentence,
        ];
    }
}
