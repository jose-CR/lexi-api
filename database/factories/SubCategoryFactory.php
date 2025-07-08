<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $SubCategory = $this->faker->randomElement(['adjetivo', 'verbo', 'sustantivo', 'descriptivo', 'indicativo']);

        return [
            'subcategory' => $SubCategory
        ];
    }
}
