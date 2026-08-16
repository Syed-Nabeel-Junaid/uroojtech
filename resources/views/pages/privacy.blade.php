<x-layout title="Privacy Policy">
    <div class="mx-auto max-w-3xl">
        <h1 class="mb-2 text-3xl font-semibold text-slate-900">Privacy Policy</h1>
        <p class="mb-8 text-sm text-slate-500">Last updated: {{ now()->format('F Y') }}</p>

        <div class="space-y-6 text-sm leading-relaxed text-slate-600">
            <p>
                This Privacy Policy explains how {{ config('business.name') }} ("we," "us," or
                "our") collects, uses, and protects information when you visit our website or
                use our services. This is a concise summary intended for our MVP storefront and
                has not been reviewed by legal counsel — it will be expanded as the business
                grows.
            </p>

            <section>
                <h2 class="mb-2 text-base font-semibold text-slate-900">Website Visitors</h2>
                <p>
                    When you browse our site, we may collect standard technical information such
                    as your IP address, browser type, and pages visited, primarily through server
                    logs and session data, to keep the site secure and functioning correctly.
                </p>
            </section>

            <section>
                <h2 class="mb-2 text-base font-semibold text-slate-900">Customer Accounts</h2>
                <p>
                    When you register for an account, we collect your name, email address, and
                    optionally your phone number. This information is used to manage your
                    account, process orders, and communicate with you about your account or
                    purchases. Passwords are stored securely using industry-standard hashing and
                    are never stored in plain text.
                </p>
            </section>

            <section>
                <h2 class="mb-2 text-base font-semibold text-slate-900">Contact Forms</h2>
                <p>
                    Information you submit through our contact form (name, email, subject, and
                    message) is used solely to respond to your inquiry. We do not use contact
                    form submissions for marketing without your separate consent.
                </p>
            </section>

            <section>
                <h2 class="mb-2 text-base font-semibold text-slate-900">Cookies &amp; Sessions</h2>
                <p>
                    We use session cookies to keep you logged in, remember your shopping cart, and
                    protect against cross-site request forgery. These cookies are required for the
                    site to function and do not track you across other websites.
                </p>
            </section>

            <section>
                <h2 class="mb-2 text-base font-semibold text-slate-900">Customer Information</h2>
                <p>
                    We do not sell or rent your personal information to third parties. Account
                    and order information is retained only as long as needed to provide our
                    services and meet basic recordkeeping needs.
                </p>
            </section>

            <section>
                <h2 class="mb-2 text-base font-semibold text-slate-900">Checkout Information</h2>
                <p>
                    During checkout, we collect the information needed to fulfill an order:
                    your name, email, phone number, and shipping address. This MVP does not
                    process real payments, so no payment card information is collected or stored
                    by this site.
                </p>
            </section>

            <section>
                <h2 class="mb-2 text-base font-semibold text-slate-900">Contact Us</h2>
                <p>
                    If you have questions about this Privacy Policy, please reach out via our
                    <a href="{{ route('contact') }}" class="font-medium text-slate-900 hover:underline">Contact page</a>
                    or at {{ config('business.email') }}.
                </p>
            </section>
        </div>
    </div>
</x-layout>
