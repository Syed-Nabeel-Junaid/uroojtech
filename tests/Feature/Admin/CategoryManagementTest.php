<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function admin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    public function test_customers_cannot_manage_categories(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($customer)->get('/admin/categories');

        $response->assertForbidden();
    }

    public function test_admin_can_create_a_category(): void
    {
        $response = $this->actingAs($this->admin())->post('/admin/categories', [
            'name' => 'Wearables',
            'description' => 'Smartwatches and fitness trackers.',
            'status' => '1',
        ]);

        $response->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseHas('categories', ['name' => 'Wearables', 'slug' => 'wearables']);
    }

    public function test_admin_can_update_a_category(): void
    {
        $category = Category::factory()->create(['name' => 'Old Name']);

        $response = $this->actingAs($this->admin())->put("/admin/categories/{$category->id}", [
            'name' => 'New Name',
            'status' => '1',
        ]);

        $response->assertRedirect(route('admin.categories.index'));
        $this->assertSame('New Name', $category->fresh()->name);
    }

    public function test_admin_can_delete_a_category_without_products(): void
    {
        $category = Category::factory()->create();

        $response = $this->actingAs($this->admin())->delete("/admin/categories/{$category->id}");

        $response->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_admin_cannot_delete_a_category_with_products(): void
    {
        $category = Category::factory()->create();
        Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($this->admin())->delete("/admin/categories/{$category->id}");

        $response->assertRedirect();
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('categories', ['id' => $category->id]);
    }

    public function test_admin_can_toggle_category_status(): void
    {
        $category = Category::factory()->create(['status' => true]);

        $this->actingAs($this->admin())->patch("/admin/categories/{$category->id}/toggle-status");

        $this->assertFalse($category->fresh()->status);
    }
}
