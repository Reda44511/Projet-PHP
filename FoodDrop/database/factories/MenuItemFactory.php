<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuItem>
 */
class MenuItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'restaurant_id' => Restaurant::factory(),
            'name' => ucfirst(fake()->words(2, true)),
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(2, 5, 25),
            'image_path' => null,
            'is_available' => true,
        ];
    }
}
