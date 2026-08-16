<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function admin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    public function test_customers_cannot_manage_products(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($customer)->get('/admin/products');

        $response->assertForbidden();
    }

    public function test_admin_can_view_product_list(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($this->admin())->get('/admin/products');

        $response->assertOk();
        $response->assertSee($product->name);
    }

    public function test_admin_can_create_a_product(): void
    {
        $category = Category::factory()->create();

        $response = $this->actingAs($this->admin())->post('/admin/products', [
            'name' => 'Test Widget',
            'sku' => 'TW-1000',
            'category_id' => $category->id,
            'brand' => 'Acme',
            'price' => 99.99,
            'short_description' => 'A test widget.',
            'description' => 'A longer description of the test widget.',
            'specifications' => "Color: Blue\nWeight: 1kg",
            'stock' => 20,
            'status' => '1',
            'featured' => '1',
        ]);

        $response->assertRedirect(route('admin.products.index'));

        $product = Product::where('sku', 'TW-1000')->first();
        $this->assertNotNull($product);
        $this->assertSame('test-widget', $product->slug);
        $this->assertTrue($product->status);
        $this->assertTrue($product->featured);
        $this->assertSame('Blue', $product->specifications['Color']);
        $this->assertSame('images/products/placeholder.svg', $product->image);
    }

    public function test_creating_a_product_requires_valid_fields(): void
    {
        $response = $this->actingAs($this->admin())->post('/admin/products', []);

        $response->assertSessionHasErrors(['name', 'sku', 'category_id', 'brand', 'price', 'short_description', 'description', 'stock']);
    }

    public function test_sku_must_be_unique(): void
    {
        $category = Category::factory()->create();
        Product::factory()->create(['category_id' => $category->id, 'sku' => 'DUPLICATE']);

        $response = $this->actingAs($this->admin())->post('/admin/products', [
            'name' => 'Another Widget',
            'sku' => 'DUPLICATE',
            'category_id' => $category->id,
            'brand' => 'Acme',
            'price' => 50,
            'short_description' => 'desc',
            'description' => 'desc',
            'stock' => 5,
        ]);

        $response->assertSessionHasErrors('sku');
    }

    public function test_sale_price_must_be_less_than_price(): void
    {
        $category = Category::factory()->create();

        $response = $this->actingAs($this->admin())->post('/admin/products', [
            'name' => 'Widget',
            'sku' => 'W-1',
            'category_id' => $category->id,
            'brand' => 'Acme',
            'price' => 50,
            'sale_price' => 60,
            'short_description' => 'desc',
            'description' => 'desc',
            'stock' => 5,
        ]);

        $response->assertSessionHasErrors('sale_price');
    }

    public function test_admin_can_update_a_product(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id, 'name' => 'Old Name']);

        $response = $this->actingAs($this->admin())->put("/admin/products/{$product->id}", [
            'name' => 'New Name',
            'sku' => $product->sku,
            'category_id' => $category->id,
            'brand' => $product->brand,
            'price' => 75,
            'short_description' => 'updated',
            'description' => 'updated',
            'stock' => 10,
        ]);

        $response->assertRedirect(route('admin.products.index'));
        $this->assertSame('New Name', $product->fresh()->name);
    }

    public function test_admin_can_delete_a_product(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($this->admin())->delete("/admin/products/{$product->id}");

        $response->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_admin_can_toggle_product_status(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id, 'status' => true]);

        $this->actingAs($this->admin())->patch("/admin/products/{$product->id}/toggle-status");

        $this->assertFalse($product->fresh()->status);
    }

    public function test_admin_can_toggle_product_featured(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id, 'featured' => false]);

        $this->actingAs($this->admin())->patch("/admin/products/{$product->id}/toggle-featured");

        $this->assertTrue($product->fresh()->featured);
    }

    public function test_admin_can_upload_a_product_image(): void
    {
        Storage::fake('public');
        $category = Category::factory()->create();

        // A real 1x1 PNG's raw bytes, so Laravel's MIME sniffing passes without
        // requiring the GD extension (not installed in this local PHP CLI).
        $pngBytes = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=');
        $file = UploadedFile::fake()->createWithContent('product.png', $pngBytes);

        $this->actingAs($this->admin())->post('/admin/products', [
            'name' => 'Image Widget',
            'sku' => 'IMG-1',
            'category_id' => $category->id,
            'brand' => 'Acme',
            'price' => 40,
            'short_description' => 'desc',
            'description' => 'desc',
            'stock' => 5,
            'image' => $file,
        ]);

        $product = Product::where('sku', 'IMG-1')->first();
        $this->assertNotNull($product);
        $this->assertStringStartsWith('storage/products/', $product->image);
        Storage::disk('public')->assertExists(str_replace('storage/', '', $product->image));
    }

    public function test_updating_a_product_without_a_new_image_keeps_the_existing_one(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id, 'image' => 'images/products/placeholder.svg']);

        $this->actingAs($this->admin())->put("/admin/products/{$product->id}", [
            'name' => $product->name,
            'sku' => $product->sku,
            'category_id' => $category->id,
            'brand' => $product->brand,
            'price' => 60,
            'short_description' => 'desc',
            'description' => 'desc',
            'stock' => 5,
        ]);

        $this->assertSame('images/products/placeholder.svg', $product->fresh()->image);
    }
}
