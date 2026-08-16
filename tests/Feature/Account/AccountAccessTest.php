<?php

namespace Tests\Feature\Account;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_login_from_account_dashboard(): void
    {
        $response = $this->get('/account');

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_customers_can_view_account_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'customer', 'name' => 'Jane Doe']);

        $response = $this->actingAs($user)->get('/account');

        $response->assertOk();
        $response->assertSee('Jane Doe');
    }

    public function test_customers_can_update_their_profile(): void
    {
        $user = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($user)->patch('/account/profile', [
            'name' => 'Updated Name',
            'email' => $user->email,
            'phone' => '555-0100',
        ]);

        $response->assertRedirect(route('account.profile.edit'));
        $this->assertSame('Updated Name', $user->fresh()->name);
        $this->assertSame('555-0100', $user->fresh()->phone);
    }

    public function test_customers_can_change_their_password(): void
    {
        $user = User::factory()->create(['role' => 'customer', 'password' => bcrypt('old-password')]);

        $response = $this->actingAs($user)->put('/account/password', [
            'current_password' => 'old-password',
            'password' => 'new-password123',
            'password_confirmation' => 'new-password123',
        ]);

        $response->assertRedirect(route('account.password.edit'));
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('new-password123', $user->fresh()->password));
    }

    public function test_password_change_requires_correct_current_password(): void
    {
        $user = User::factory()->create(['role' => 'customer', 'password' => bcrypt('old-password')]);

        $response = $this->actingAs($user)->put('/account/password', [
            'current_password' => 'wrong-password',
            'password' => 'new-password123',
            'password_confirmation' => 'new-password123',
        ]);

        $response->assertSessionHasErrors('current_password');
    }
}
