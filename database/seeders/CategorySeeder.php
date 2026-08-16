<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Realistic technology-product categories for the storefront.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Laptops', 'description' => 'Laptops for work, gaming, and everyday use.'],
            ['name' => 'Smartphones', 'description' => 'Smartphones with the latest features and performance.'],
            ['name' => 'Tablets', 'description' => 'Tablets for productivity, entertainment, and creativity.'],
            ['name' => 'Monitors', 'description' => 'Displays for gaming, design, and office work.'],
            ['name' => 'Keyboards', 'description' => 'Mechanical and membrane keyboards for every workflow.'],
            ['name' => 'Mice', 'description' => 'Ergonomic and precision mice for work and gaming.'],
            ['name' => 'Headphones', 'description' => 'Wired and wireless headphones and earbuds.'],
            ['name' => 'Networking', 'description' => 'Routers, switches, and networking equipment.'],
            ['name' => 'Storage', 'description' => 'External drives, SSDs, and memory cards.'],
            ['name' => 'Accessories', 'description' => 'Cables, chargers, stands, and other tech accessories.'],
        ];

        foreach ($categories as $category) {
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
}
