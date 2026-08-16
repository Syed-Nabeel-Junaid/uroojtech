<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function admin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    public function test_customers_cannot_view_the_customer_list(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($customer)->get('/admin/customers');

        $response->assertForbidden();
    }

    public function test_admin_can_view_customer_list(): void
    {
        $customer = User::factory()->create(['role' => 'customer', 'name' => 'Jane Doe']);

        $response = $this->actingAs($this->admin())->get('/admin/customers');

        $response->assertOk();
        $response->assertSee('Jane Doe');
    }

    public function test_customer_list_excludes_admins(): void
    {
        $admin = $this->admin();
        $otherAdmin = User::factory()->create(['role' => 'admin', 'name' => 'Other Admin']);

        $response = $this->actingAs($admin)->get('/admin/customers');

        $response->assertDontSee('Other Admin');
    }

    public function test_customer_list_can_be_searched(): void
    {
        User::factory()->create(['role' => 'customer', 'name' => 'Jane Doe', 'email' => 'jane@example.com']);
        User::factory()->create(['role' => 'customer', 'name' => 'John Smith', 'email' => 'john@example.com']);

        $response = $this->actingAs($this->admin())->get('/admin/customers?search=jane');

        $response->assertSee('Jane Doe');
        $response->assertDontSee('John Smith');
    }

    public function test_admin_can_view_customer_details(): void
    {
        $customer = User::factory()->create(['role' => 'customer', 'name' => 'Jane Doe']);

        $response = $this->actingAs($this->admin())->get("/admin/customers/{$customer->id}");

        $response->assertOk();
        $response->assertSee('Jane Doe');
    }

    public function test_viewing_an_admin_as_a_customer_detail_returns_404(): void
    {
        $otherAdmin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($this->admin())->get("/admin/customers/{$otherAdmin->id}");

        $response->assertNotFound();
    }
}
