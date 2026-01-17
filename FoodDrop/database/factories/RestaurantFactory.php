<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'description' => fake()->paragraph(),
            'category' => fake()->randomElement([
                'Burgers',
                'Pizza',
                'Healthy',
                'Sushi',
                'Desserts',
                'Local',
            ]),
            'image_path' => null,
            'is_active' => true,
        ];
    }
}
