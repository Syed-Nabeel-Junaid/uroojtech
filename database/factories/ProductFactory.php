<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Product>
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
        $name = fake()->unique()->words(3, true);
        $price = fake()->randomFloat(2, 20, 2500);

        return [
            'name' => ucwords($name),
            'slug' => Str::slug($name).'-'.fake()->unique()->numberBetween(1000, 9999),
            'sku' => strtoupper(Str::random(3)).'-'.fake()->unique()->numberBetween(10000, 99999),
            'category_id' => Category::factory(),
            'brand' => fake()->randomElement(['Acme', 'NovaTech', 'Zenith', 'Kestrel', 'Vantage']),
            'price' => $price,
            'sale_price' => null,
            'short_description' => fake()->sentence(10),
            'description' => fake()->paragraphs(3, true),
            'specifications' => null,
            'stock' => fake()->numberBetween(0, 100),
            'status' => true,
            'featured' => false,
            'image' => null,
        ];
    }
}
