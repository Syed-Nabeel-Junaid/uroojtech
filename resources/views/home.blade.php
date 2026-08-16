<x-layout title="Home" description="{{ config('app.name') }} is a modern technology store for laptops, smartphones, tablets, and accessories — curated for performance, reliability, and everyday value.">
    <section class="mb-16 overflow-hidden rounded-2xl bg-slate-900 text-white">
        <div class="grid items-center gap-8 px-6 py-10 sm:px-8 sm:py-16 md:grid-cols-2 md:px-14">
            <div class="animate-hero-in-1 md:order-2">
                <img src="{{ asset('images/hero/workspace-devices.jpg') }}"
                     alt="Laptop, smartphone, and notebook arranged on a desk"
                     class="aspect-video w-full rounded-2xl object-cover shadow-2xl md:aspect-square">
            </div>
            <div class="flex flex-col justify-center md:order-1">
                <span class="animate-hero-in mb-4 text-sm font-medium uppercase tracking-wide text-slate-400">
                    {{ config('app.name') }}
                </span>
                <h1 class="animate-hero-in-1 text-4xl font-semibold leading-tight md:text-5xl">
                    Technology that keeps up with you.
                </h1>
                <p class="animate-hero-in-2 mt-4 max-w-md text-slate-300">
                    Laptops, smartphones, and accessories curated for performance,
                    reliability, and everyday value.
                </p>
                <a href="{{ route('shop.index') }}"
                   class="animate-hero-in-3 mt-8 inline-block w-fit rounded-md bg-white px-6 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-100">
                    Shop Now
                </a>
            </div>
        </div>
    </section>

    @if ($featuredProducts->isNotEmpty())
        <section class="mb-16">
            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-2xl font-semibold text-slate-900">Featured Products</h2>
                <a href="{{ route('shop.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">
                    View all &rarr;
                </a>
            </div>

            <div class="grid grid-cols-2 gap-6 sm:grid-cols-3 lg:grid-cols-4">
                @foreach ($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </section>
    @endif

    <section class="mb-16">
        <h2 class="mb-6 text-2xl font-semibold text-slate-900">Shop by Category</h2>

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-5">
            @foreach ($categories as $category)
                <a href="{{ route('shop.index', ['category' => $category->slug]) }}"
                   class="flex flex-col items-center gap-2 rounded-lg border border-slate-200 bg-white p-5 text-center transition hover:border-slate-300 hover:shadow-sm">
                    <span class="text-sm font-medium text-slate-900">{{ $category->name }}</span>
                    <span class="text-xs text-slate-500">{{ $category->products_count }} products</span>
                </a>
            @endforeach
        </div>
    </section>

    <section class="mb-16">
        <h2 class="mb-6 text-2xl font-semibold text-slate-900">Why {{ config('app.name') }}</h2>

        <div class="grid gap-6 sm:grid-cols-3">
            <div class="rounded-lg border border-slate-200 bg-white p-6">
                <h3 class="mb-2 text-sm font-semibold text-slate-900">Curated Selection</h3>
                <p class="text-sm text-slate-600">
                    Every product is chosen for reliable, everyday performance.
                </p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-white p-6">
                <h3 class="mb-2 text-sm font-semibold text-slate-900">Straightforward Pricing</h3>
                <p class="text-sm text-slate-600">
                    Clear pricing with sale prices called out — no surprises at checkout.
                </p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-white p-6">
                <h3 class="mb-2 text-sm font-semibold text-slate-900">Built to Grow</h3>
                <p class="text-sm text-slate-600">
                    A modern storefront designed to expand with more products and services.
                </p>
            </div>
        </div>
    </section>

    <section class="rounded-2xl border border-slate-200 bg-white p-10 text-center">
        <h2 class="text-xl font-semibold text-slate-900">Looking for the right tech?</h2>
        <p class="mx-auto mt-2 max-w-md text-sm text-slate-600">
            Browse the full catalog and filter by category, brand, and price to find exactly
            what you need.
        </p>
        <a href="{{ route('shop.index') }}"
           class="mt-6 inline-block rounded-md bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-700">
            Browse the Shop
        </a>
    </section>
</x-layout>
