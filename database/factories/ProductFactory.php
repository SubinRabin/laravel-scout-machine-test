<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraphs(3, true),
            'category' => implode(',', $this->faker->words(1)),
            'price' => $this->faker->randomFloat(2, 10, 1000), // price as a float between 10 and 1000
        ];
    }
}
