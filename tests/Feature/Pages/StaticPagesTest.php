<?php

namespace Tests\Feature\Pages;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class StaticPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_about_page_can_be_rendered(): void
    {
        $response = $this->get('/about');

        $response->assertOk();
        $response->assertSee('About');
    }

    public function test_privacy_policy_page_can_be_rendered(): void
    {
        $response = $this->get('/privacy-policy');

        $response->assertOk();
        $response->assertSee('Privacy Policy');
    }

    public function test_terms_page_can_be_rendered(): void
    {
        $response = $this->get('/terms');

        $response->assertOk();
        $response->assertSee('Terms');
    }

    public function test_contact_page_can_be_rendered(): void
    {
        $response = $this->get('/contact');

        $response->assertOk();
        $response->assertSee('Contact Us');
    }

    public function test_contact_form_requires_valid_fields(): void
    {
        $response = $this->post('/contact', []);

        $response->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
    }

    public function test_contact_form_can_be_submitted(): void
    {
        Log::shouldReceive('info')->once();

        $response = $this->post('/contact', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'subject' => 'Question about a laptop',
            'message' => 'Does this laptop come with a warranty?',
        ]);

        $response->assertRedirect(route('contact'));
        $response->assertSessionHas('status');
    }

    public function test_footer_shows_business_contact_information(): void
    {
        $response = $this->get('/');

        $response->assertSee(config('business.email'));
        $response->assertSee(config('business.phone'));
    }
}
