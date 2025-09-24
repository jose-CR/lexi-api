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
        if ($this->faker->boolean(50)) {
            $times = collect(['pasado', 'ing'])
                ->mapWithKeys(function ($key) {
                    return [
                        $key => [
                            'definition' => [
                                $this->faker->word(),
                                $this->faker->word(),
                                $this->faker->word(),
                            ],
                            'spanishSentence' => $this->faker->sentence(),
                            'sentence' => $this->faker->sentence(),
                        ],
                    ];
                })->toArray();
        } else {
            $times = null;
        }

        return [
            'letter' => $letter,
            'word' => $word,
            'definition' => $definition,
            'spanish_sentence' => $spanishSentence,
            'sentence' => $sentence,
            'times' => $times,
        ];
    }
}
