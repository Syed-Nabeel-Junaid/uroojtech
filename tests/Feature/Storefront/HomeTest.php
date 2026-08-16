<?php

namespace Tests\Feature\Storefront;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_can_be_rendered(): void
    {
        $response = $this->get('/');

        $response->assertOk();
    }

    public function test_home_page_shows_featured_products(): void
    {
        $category = Category::factory()->create();
        $featured = Product::factory()->create([
            'category_id' => $category->id,
            'featured' => true,
            'status' => true,
        ]);
        Product::factory()->create([
            'category_id' => $category->id,
            'featured' => false,
            'status' => true,
        ]);

        $response = $this->get('/');

        $response->assertSee($featured->name);
    }

    public function test_home_page_shows_active_categories(): void
    {
        $category = Category::factory()->create(['status' => true]);

        $response = $this->get('/');

        $response->assertSee($category->name);
    }
}
