<x-layout title="Terms & Conditions">
    <div class="mx-auto max-w-3xl">
        <h1 class="mb-2 text-3xl font-semibold text-slate-900">Terms &amp; Conditions</h1>
        <p class="mb-8 text-sm text-slate-500">Last updated: {{ now()->format('F Y') }}</p>

        <div class="space-y-6 text-sm leading-relaxed text-slate-600">
            <p>
                These Terms &amp; Conditions govern your use of the {{ config('business.name') }}
                website. By using this site, you agree to these terms. This is a concise summary
                appropriate for our current MVP and will be expanded as the business grows.
            </p>

            <section>
                <h2 class="mb-2 text-base font-semibold text-slate-900">Website Usage</h2>
                <p>
                    You agree to use this site only for lawful purposes and in a way that does
                    not infringe the rights of, or restrict or inhibit the use of, this site by
                    anyone else.
                </p>
            </section>

            <section>
                <h2 class="mb-2 text-base font-semibold text-slate-900">Accounts</h2>
                <p>
                    You are responsible for maintaining the confidentiality of your account
                    credentials and for all activity under your account. Notify us promptly if
                    you suspect unauthorized use of your account.
                </p>
            </section>

            <section>
                <h2 class="mb-2 text-base font-semibold text-slate-900">Products &amp; Product Information</h2>
                <p>
                    We aim to display product details, including images, pricing, and
                    specifications, as accurately as possible. However, we do not warrant that
                    product descriptions or other content are error-free, complete, or current.
                </p>
            </section>

            <section>
                <h2 class="mb-2 text-base font-semibold text-slate-900">Pricing &amp; Availability</h2>
                <p>
                    Prices and product availability are subject to change without notice. In the
                    event a product is listed at an incorrect price or is no longer available, we
                    reserve the right to cancel or adjust the order.
                </p>
            </section>

            <section>
                <h2 class="mb-2 text-base font-semibold text-slate-900">Checkout &amp; Orders</h2>
                <p>
                    This site's checkout flow is currently a demonstration for our MVP: no
                    payment is processed, and orders placed through this site are not fulfilled
                    or shipped. Real order processing will be introduced in a future phase.
                </p>
            </section>

            <section>
                <h2 class="mb-2 text-base font-semibold text-slate-900">Intellectual Property</h2>
                <p>
                    All content on this site, including text, graphics, logos, and images (other
                    than product photography which may be sourced separately), is the property of
                    {{ config('business.name') }} or its licensors and may not be used without
                    permission.
                </p>
            </section>

            <section>
                <h2 class="mb-2 text-base font-semibold text-slate-900">Liability</h2>
                <p>
                    This site is provided "as is" without warranties of any kind. To the fullest
                    extent permitted by law, {{ config('business.name') }} is not liable for any
                    indirect or consequential damages arising from your use of this site.
                </p>
            </section>

            <section>
                <h2 class="mb-2 text-base font-semibold text-slate-900">Changes to These Terms</h2>
                <p>
                    We may update these Terms &amp; Conditions from time to time. Continued use of
                    the site after changes are posted constitutes acceptance of the revised
                    terms.
                </p>
            </section>

            <section>
                <h2 class="mb-2 text-base font-semibold text-slate-900">Contact Us</h2>
                <p>
                    Questions about these terms can be sent via our
                    <a href="{{ route('contact') }}" class="font-medium text-slate-900 hover:underline">Contact page</a>
                    or to {{ config('business.email') }}.
                </p>
            </section>
        </div>
    </div>
</x-layout>
