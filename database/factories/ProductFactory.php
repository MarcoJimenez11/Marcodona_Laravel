<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

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
        $categories = Category::all()->pluck('id');

        return [
            'category_id' => fake()->randomElement($categories),
            'name' => fake()->text(30),
            'description' => fake()->paragraph(1),
            'price' => fake()->randomFloat(2, 1,20),
            'stock' => fake()->numberBetween(0,1000),
            'image' => fake()->text(16),
        ];
    }
}
