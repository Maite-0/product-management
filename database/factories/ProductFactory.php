<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

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
            'title' => $this->faker->word(),  // Fake product title (one word)
            'description' => $this->faker->paragraph(),  // Fake product description (a paragraph)
            'price' => $this->faker->randomFloat(2, 10, 500),  // Fake price between 10 and 500 with 2 decimals
            'stock' => $this->faker->numberBetween(0, 1000),  // Fake stock quantity between 0 and 1000
            'image_url' => $this->faker->imageUrl(640, 480, 'products'),  // Fake product image URL
            'category' => $this->faker->word(),  // Fake product category
            'sku' => $this->faker->unique()->lexify('????-????'),  // Fake SKU (unique, 8 characters)
            'status' => $this->faker->randomElement(['active', 'inactive']),  // Randomly set status
            'created_by' => '3',  // Fake user ID for created_by, assuming you have a User model
            'updated_by' => \App\Models\User::factory(),  // Fake user ID for updated_by
        ];
    }
}
