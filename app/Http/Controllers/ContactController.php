<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Display the contact form.
     */
    public function create(): View
    {
        return view('contact.create');
    }

    /**
     * Handle a contact form submission.
     *
     * Real email delivery is out of scope for this MVP (per project spec) —
     * Laravel's mail configuration (config/mail.php, MAIL_* env vars) is
     * already in place so sending a notification from here is a small,
     * self-contained addition for a future phase. For now the submission is
     * logged so it isn't silently discarded.
     */
    public function store(ContactRequest $request): RedirectResponse
    {
        Log::info('Contact form submission', $request->validated());

        return redirect()->route('contact')->with('status', 'Thanks for reaching out — we\'ll get back to you soon.');
    }
}
