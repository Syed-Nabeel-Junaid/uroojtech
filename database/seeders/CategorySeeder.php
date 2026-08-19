<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * The 5 categories that make up the real gaming-hardware catalog.
     */
    private const CATEGORIES = [
        ['name' => 'Gaming PCs', 'description' => 'Prebuilt gaming desktops with the latest CPUs and NVIDIA GeForce RTX graphics.'],
        ['name' => 'Gaming Consoles', 'description' => 'Living-room gaming consoles and console bundles.'],
        ['name' => 'Gaming Laptops', 'description' => 'High-performance laptops built for gaming and content creation on the go.'],
        ['name' => 'Mice & Input', 'description' => 'Precision gaming and professional 3D-navigation input devices.'],
        ['name' => 'Components', 'description' => 'Graphics cards and other high-end PC components.'],
    ];

    public function run(): void
    {
        foreach (self::CATEGORIES as $category) {
            Category::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'status' => true,
                ]
            );
        }
    }

    /**
     * Remove any category that isn't part of the current 5-category catalog.
     *
     * Must run after ProductSeeder, once no product references the old
     * categories — products.category_id has a restrictOnDelete FK, so this
     * would fail if any product still pointed at one of them.
     */
    public function pruneOldCategories(): void
    {
        $currentSlugs = array_map(fn ($category) => Str::slug($category['name']), self::CATEGORIES);

        Category::whereNotIn('slug', $currentSlugs)->delete();
    }
}
