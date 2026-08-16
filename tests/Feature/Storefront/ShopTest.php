<?php

namespace Tests\Feature\Storefront;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShopTest extends TestCase
{
    use RefreshDatabase;

    public function test_shop_page_lists_active_products(): void
    {
        $category = Category::factory()->create();
        $active = Product::factory()->create(['category_id' => $category->id, 'status' => true]);
        $inactive = Product::factory()->create(['category_id' => $category->id, 'status' => false]);

        $response = $this->get('/shop');

        $response->assertOk();
        $response->assertSee($active->name);
        $response->assertDontSee($inactive->name);
    }

    public function test_shop_can_be_filtered_by_category(): void
    {
        $laptops = Category::factory()->create(['name' => 'Laptops', 'slug' => 'laptops']);
        $phones = Category::factory()->create(['name' => 'Smartphones', 'slug' => 'smartphones']);

        $laptop = Product::factory()->create(['category_id' => $laptops->id, 'status' => true]);
        $phone = Product::factory()->create(['category_id' => $phones->id, 'status' => true]);

        $response = $this->get('/shop?category=laptops');

        $response->assertSee($laptop->name);
        $response->assertDontSee($phone->name);
    }

    public function test_shop_can_be_filtered_by_brand(): void
    {
        $category = Category::factory()->create();
        $acme = Product::factory()->create(['category_id' => $category->id, 'brand' => 'Acme', 'status' => true]);
        $zenith = Product::factory()->create(['category_id' => $category->id, 'brand' => 'Zenith', 'status' => true]);

        $response = $this->get('/shop?brand=Acme');

        $response->assertSee($acme->name);
        $response->assertDontSee($zenith->name);
    }

    public function test_shop_can_be_filtered_by_price_range(): void
    {
        $category = Category::factory()->create();
        $cheap = Product::factory()->create(['category_id' => $category->id, 'price' => 50, 'status' => true]);
        $expensive = Product::factory()->create(['category_id' => $category->id, 'price' => 2000, 'status' => true]);

        $response = $this->get('/shop?min_price=1000&max_price=3000');

        $response->assertSee($expensive->name);
        $response->assertDontSee($cheap->name);
    }

    public function test_shop_can_be_searched(): void
    {
        $category = Category::factory()->create();
        $match = Product::factory()->create([
            'category_id' => $category->id,
            'name' => 'Kestrel Pro Laptop',
            'brand' => 'Kestrel',
            'short_description' => 'A reliable everyday laptop.',
            'status' => true,
        ]);
        $noMatch = Product::factory()->create([
            'category_id' => $category->id,
            'name' => 'Zenith Mouse',
            'brand' => 'Zenith',
            'short_description' => 'A precise wireless pointing device.',
            'status' => true,
        ]);

        $response = $this->get('/shop?search=Kestrel');

        $response->assertSee($match->name);
        $response->assertDontSee($noMatch->name);
    }

    public function test_shop_can_be_sorted_by_price_ascending(): void
    {
        $category = Category::factory()->create();
        Product::factory()->create(['category_id' => $category->id, 'name' => 'Expensive Item', 'price' => 500, 'status' => true]);
        Product::factory()->create(['category_id' => $category->id, 'name' => 'Cheap Item', 'price' => 50, 'status' => true]);

        $response = $this->get('/shop?sort=price_asc');

        $content = $response->getContent();
        $this->assertTrue(strpos($content, 'Cheap Item') < strpos($content, 'Expensive Item'));
    }

    public function test_shop_paginates_results(): void
    {
        $category = Category::factory()->create();
        Product::factory()->count(15)->create(['category_id' => $category->id, 'status' => true]);

        $response = $this->get('/shop');

        $response->assertOk();
        $response->assertViewHas('products', fn ($products) => $products->count() === 12);
    }

    public function test_product_detail_page_can_be_rendered(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id, 'status' => true]);

        $response = $this->get(route('shop.show', $product));

        $response->assertOk();
        $response->assertSee($product->name);
        $response->assertSee($product->sku);
    }

    public function test_inactive_product_detail_page_returns_404(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id, 'status' => false]);

        $response = $this->get(route('shop.show', $product));

        $response->assertNotFound();
    }
}
