<?php

namespace Tests\Feature\Cart;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    protected function makeProduct(array $overrides = []): Product
    {
        $category = Category::factory()->create();

        return Product::factory()->create(array_merge([
            'category_id' => $category->id,
            'status' => true,
            'price' => 100,
            'sale_price' => null,
            'stock' => 10,
        ], $overrides));
    }

    public function test_cart_page_shows_empty_state(): void
    {
        $response = $this->get('/cart');

        $response->assertOk();
        $response->assertSee('Your cart is empty');
    }

    public function test_a_product_can_be_added_to_the_cart(): void
    {
        $product = $this->makeProduct();

        $response = $this->post('/cart', ['product_id' => $product->id, 'quantity' => 2]);

        $response->assertRedirect();
        $this->assertEquals(2, session('cart')[$product->id]);
    }

    public function test_adding_to_cart_requires_a_valid_product(): void
    {
        $response = $this->post('/cart', ['product_id' => 999999, 'quantity' => 1]);

        $response->assertSessionHasErrors('product_id');
    }

    public function test_adding_to_cart_requires_a_valid_quantity(): void
    {
        $product = $this->makeProduct();

        $response = $this->post('/cart', ['product_id' => $product->id, 'quantity' => 0]);

        $response->assertSessionHasErrors('quantity');
    }

    public function test_adding_more_than_available_stock_is_clamped(): void
    {
        $product = $this->makeProduct(['stock' => 3]);

        $this->post('/cart', ['product_id' => $product->id, 'quantity' => 10]);

        $this->assertEquals(3, session('cart')[$product->id]);
    }

    public function test_cannot_add_an_out_of_stock_product(): void
    {
        $product = $this->makeProduct(['stock' => 0]);

        $response = $this->post('/cart', ['product_id' => $product->id, 'quantity' => 1]);

        $response->assertSessionHas('error');
        $this->assertArrayNotHasKey($product->id, session('cart', []));
    }

    public function test_cart_page_shows_added_items_with_subtotal(): void
    {
        $product = $this->makeProduct(['price' => 50]);

        $this->post('/cart', ['product_id' => $product->id, 'quantity' => 3]);

        $response = $this->get('/cart');

        $response->assertSee($product->name);
        $response->assertSee('150.00');
    }

    public function test_cart_uses_sale_price_when_present(): void
    {
        $product = $this->makeProduct(['price' => 100, 'sale_price' => 80]);

        $this->post('/cart', ['product_id' => $product->id, 'quantity' => 2]);

        $response = $this->get('/cart');

        $response->assertSee('160.00');
    }

    public function test_quantity_can_be_updated(): void
    {
        $product = $this->makeProduct();
        $this->post('/cart', ['product_id' => $product->id, 'quantity' => 1]);

        $response = $this->patch("/cart/{$product->id}", ['quantity' => 5]);

        $response->assertRedirect();
        $this->assertEquals(5, session('cart')[$product->id]);
    }

    public function test_updating_quantity_to_zero_removes_the_item(): void
    {
        $product = $this->makeProduct();
        $this->post('/cart', ['product_id' => $product->id, 'quantity' => 1]);

        $this->patch("/cart/{$product->id}", ['quantity' => 0]);

        $this->assertArrayNotHasKey($product->id, session('cart', []));
    }

    public function test_a_product_can_be_removed_from_the_cart(): void
    {
        $product = $this->makeProduct();
        $this->post('/cart', ['product_id' => $product->id, 'quantity' => 1]);

        $response = $this->delete("/cart/{$product->id}");

        $response->assertRedirect();
        $this->assertArrayNotHasKey($product->id, session('cart', []));
    }

    public function test_a_product_deactivated_after_being_added_is_removed_on_view(): void
    {
        $product = $this->makeProduct();
        $this->post('/cart', ['product_id' => $product->id, 'quantity' => 1]);
        $this->get('/cart'); // consume the "added to cart" flash message before asserting

        $product->update(['status' => false]);

        $response = $this->get('/cart');

        $response->assertDontSee($product->name);
        $this->assertArrayNotHasKey($product->id, session('cart', []));
    }

    public function test_a_product_with_reduced_stock_is_clamped_on_view(): void
    {
        $product = $this->makeProduct(['stock' => 10]);
        $this->post('/cart', ['product_id' => $product->id, 'quantity' => 8]);

        $product->update(['stock' => 2]);

        $response = $this->get('/cart');

        $response->assertOk();
        $this->assertEquals(2, session('cart')[$product->id]);
    }

    public function test_cart_count_reflects_total_quantity_across_items(): void
    {
        $productA = $this->makeProduct();
        $productB = $this->makeProduct();

        $this->post('/cart', ['product_id' => $productA->id, 'quantity' => 3]);
        $this->post('/cart', ['product_id' => $productB->id, 'quantity' => 2]);

        $this->assertEquals(5, app(\App\Support\Cart::class)->count());
    }
}
