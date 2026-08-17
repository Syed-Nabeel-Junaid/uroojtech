<x-layout title="FAQ">
    <div class="mx-auto max-w-3xl">
        <h1 class="mb-2 text-3xl font-semibold text-slate-900">Frequently Asked Questions</h1>
        <p class="mb-8 text-sm text-slate-500">
            Answers to common questions about shopping with {{ config('business.name') }}. Can't
            find what you're looking for? Reach out via our
            <a href="{{ route('contact') }}" class="font-medium text-slate-900 hover:underline">Contact page</a>.
        </p>

        @php
            $faqs = [
                [
                    'question' => 'What products does Urooj Tech sell?',
                    'answer' => 'We sell laptops, smartphones, tablets, monitors, keyboards, mice, headphones, storage devices, networking gear, and other technology accessories, curated for performance and reliability.',
                ],
                [
                    'question' => 'How can I place an order?',
                    'answer' => "Browse the shop, add the items you want to your cart, then proceed to checkout and fill in your details to place your order. Note that our checkout is currently a demonstration for this MVP — no payment is processed and orders are not yet fulfilled or shipped.",
                ],
                [
                    'question' => 'Do I need an account to shop?',
                    'answer' => "You can browse products and view the shop without an account. You'll need to log in or register once you're ready to check out.",
                ],
                [
                    'question' => 'How does the cart work?',
                    'answer' => 'Add products to your cart from the shop or a product page, then adjust quantities or remove items from the cart page at any time. Your cart shows a running subtotal and stays linked to your session as you continue shopping.',
                ],
                [
                    'question' => 'What payment methods are available?',
                    'answer' => "We're finalizing our payment options as we roll out full order processing. Checkout currently does not collect any payment — accepted payment methods will be listed at checkout once live order processing is introduced.",
                ],
                [
                    'question' => 'Do you offer delivery/shipping?',
                    'answer' => "Our delivery and shipping details are still being finalized. Once live order processing is available, shipping options and estimated delivery times will be shown at checkout and in your order confirmation.",
                ],
                [
                    'question' => 'How can I contact Urooj Tech?',
                    'answer' => "You can reach us anytime through our <a href=\"" . route('contact') . "\" class=\"font-medium text-slate-900 hover:underline\">Contact page</a>, or by emailing " . config('business.email') . '.',
                ],
                [
                    'question' => 'Can I return or exchange a product?',
                    'answer' => "Yes — eligible items can be returned within 7 days of delivery. See our full <a href=\"" . route('return-policy') . "\" class=\"font-medium text-slate-900 hover:underline\">Return Policy</a> for eligibility details and how to start a return.",
                ],
                [
                    'question' => 'How can I reset my password?',
                    'answer' => "Use the “Forgot password?” link on the login page to receive a password reset link by email.",
                ],
                [
                    'question' => 'Is my account information secure?',
                    'answer' => "Yes. Passwords are stored using industry-standard hashing and are never stored in plain text. See our <a href=\"" . route('privacy') . "\" class=\"font-medium text-slate-900 hover:underline\">Privacy Policy</a> for details on how we handle your information.",
                ],
            ];
        @endphp

        <div class="divide-y divide-slate-200 rounded-lg border border-slate-200 bg-white">
            @foreach ($faqs as $faq)
                <details class="group px-6 py-4">
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-sm font-medium text-slate-900 [&::-webkit-details-marker]:hidden">
                        {{ $faq['question'] }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-slate-400 transition-transform group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </summary>
                    <p class="mt-3 text-sm leading-relaxed text-slate-600">{!! $faq['answer'] !!}</p>
                </details>
            @endforeach
        </div>
    </div>
</x-layout>
