<?php

namespace Tests\Feature\Checkout;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutTest extends TestCase
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

    protected function validShippingData(): array
    {
        return [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => '555-0100',
            'address' => '123 Main St',
            'city' => 'Springfield',
            'state' => 'IL',
            'postal_code' => '62704',
            'country' => 'USA',
        ];
    }

    public function test_guests_are_redirected_to_login_from_checkout(): void
    {
        $response = $this->get('/checkout');

        $response->assertRedirect(route('login'));
    }

    public function test_guest_is_returned_to_checkout_after_logging_in(): void
    {
        $user = User::factory()->create(['role' => 'customer']);
        $product = $this->makeProduct();
        $this->post('/cart', ['product_id' => $product->id, 'quantity' => 1]);

        // Guest hits checkout, gets redirected to login with intended URL captured.
        $this->get('/checkout');

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('checkout.index'));
    }

    public function test_authenticated_customer_with_empty_cart_is_redirected_to_cart(): void
    {
        $user = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($user)->get('/checkout');

        $response->assertRedirect(route('cart.index'));
    }

    public function test_authenticated_customer_with_items_can_view_checkout(): void
    {
        $user = User::factory()->create(['role' => 'customer']);
        $product = $this->makeProduct();
        $this->actingAs($user)->post('/cart', ['product_id' => $product->id, 'quantity' => 2]);

        $response = $this->actingAs($user)->get('/checkout');

        $response->assertOk();
        $response->assertSee($product->name);
        $response->assertSee('200.00'); // 100 * 2
    }

    public function test_placing_an_order_requires_valid_fields(): void
    {
        $user = User::factory()->create(['role' => 'customer']);
        $product = $this->makeProduct();
        $this->actingAs($user)->post('/cart', ['product_id' => $product->id, 'quantity' => 1]);

        $response = $this->actingAs($user)->post('/checkout', []);

        $response->assertSessionHasErrors(['name', 'email', 'phone', 'address', 'city', 'state', 'postal_code', 'country']);
    }

    public function test_placing_a_valid_order_clears_the_cart_and_shows_confirmation(): void
    {
        $user = User::factory()->create(['role' => 'customer']);
        $product = $this->makeProduct(['price' => 150]);
        $this->actingAs($user)->post('/cart', ['product_id' => $product->id, 'quantity' => 2]);

        $response = $this->actingAs($user)->post('/checkout', $this->validShippingData());

        $response->assertRedirect(route('checkout.confirmation'));
        $this->assertArrayNotHasKey($product->id, session('cart', []));

        $confirmationResponse = $this->actingAs($user)->get(route('checkout.confirmation'));
        $confirmationResponse->assertOk();
        $confirmationResponse->assertSee($product->name);
        $confirmationResponse->assertSee('300.00'); // 150 * 2
        $confirmationResponse->assertSee('Jane Doe');
    }

    public function test_cannot_place_an_order_with_an_empty_cart(): void
    {
        $user = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($user)->post('/checkout', $this->validShippingData());

        $response->assertRedirect(route('cart.index'));
    }

    public function test_confirmation_page_redirects_without_a_completed_order(): void
    {
        $user = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($user)->get(route('checkout.confirmation'));

        $response->assertRedirect(route('shop.index'));
    }
}
