<x-layout title="Shop" description="Browse the full {{ config('app.name') }} catalog — filter by category, brand, and price to find the right laptop, smartphone, or accessory.">
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-slate-900">Shop</h1>
        <p class="mt-1 text-sm text-slate-600">{{ $products->total() }} products</p>
    </div>

    <div class="grid gap-8 lg:grid-cols-[240px_1fr]">
        <aside class="space-y-6">
            <form method="GET" action="{{ route('shop.index') }}" class="space-y-6">
                <div>
                    <label for="search" class="mb-1 block text-sm font-medium text-slate-700">Search</label>
                    <input id="search" name="search" type="text" value="{{ request('search') }}"
                           placeholder="Search products..."
                           class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
                </div>

                <div>
                    <span class="mb-2 block text-sm font-medium text-slate-700">Category</span>
                    <div class="space-y-1">
                        <label class="flex items-center gap-2 text-sm text-slate-600">
                            <input type="radio" name="category" value="" {{ request('category') ? '' : 'checked' }}
                                   onchange="this.form.submit()">
                            All Categories
                        </label>
                        @foreach ($categories as $category)
                            <label class="flex items-center gap-2 text-sm text-slate-600">
                                <input type="radio" name="category" value="{{ $category->slug }}"
                                       {{ request('category') === $category->slug ? 'checked' : '' }}
                                       onchange="this.form.submit()">
                                {{ $category->name }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <span class="mb-2 block text-sm font-medium text-slate-700">Brand</span>
                    <div class="space-y-1">
                        <label class="flex items-center gap-2 text-sm text-slate-600">
                            <input type="radio" name="brand" value="" {{ request('brand') ? '' : 'checked' }}
                                   onchange="this.form.submit()">
                            All Brands
                        </label>
                        @foreach ($brands as $brand)
                            <label class="flex items-center gap-2 text-sm text-slate-600">
                                <input type="radio" name="brand" value="{{ $brand }}"
                                       {{ request('brand') === $brand ? 'checked' : '' }}
                                       onchange="this.form.submit()">
                                {{ $brand }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <span class="mb-2 block text-sm font-medium text-slate-700">Price Range</span>
                    <div class="flex items-center gap-2">
                        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min"
                               min="0" class="w-full rounded-md border border-slate-300 px-2 py-1.5 text-sm">
                        <span class="text-slate-400">–</span>
                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max"
                               min="0" class="w-full rounded-md border border-slate-300 px-2 py-1.5 text-sm">
                    </div>
                </div>

                @if (request('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif

                <div class="flex gap-2">
                    <button type="submit"
                            class="flex-1 rounded-md bg-slate-900 px-3 py-2 text-sm font-medium text-white hover:bg-slate-700">
                        Apply Filters
                    </button>
                    <a href="{{ route('shop.index') }}"
                       class="rounded-md border border-slate-300 px-3 py-2 text-sm font-medium text-slate-600 hover:border-slate-400">
                        Reset
                    </a>
                </div>
            </form>
        </aside>

        <div>
            <div class="mb-6 flex justify-end">
                <form method="GET" action="{{ route('shop.index') }}" class="flex items-center gap-2">
                    @foreach (request()->except('sort', 'page') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach

                    <label for="sort" class="text-sm text-slate-600">Sort by</label>
                    <select id="sort" name="sort" onchange="this.form.submit()"
                            class="rounded-md border border-slate-300 px-3 py-1.5 text-sm">
                        <option value="newest" {{ request('sort', 'newest') === 'newest' ? 'selected' : '' }}>Newest</option>
                        <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>
                </form>
            </div>

            @if ($products->isEmpty())
                <div class="rounded-lg border border-dashed border-slate-300 bg-white p-12 text-center text-sm text-slate-500">
                    No products match your filters. Try adjusting your search or filters.
                </div>
            @else
                <div class="grid grid-cols-2 gap-6 sm:grid-cols-3">
                    @foreach ($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layout>
