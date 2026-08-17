<x-layout title="{{ $product->name }}" description="{{ $product->short_description }}">
    <nav class="mb-6 text-sm text-slate-500">
        <a href="{{ route('shop.index') }}" class="hover:text-slate-700">Shop</a>
        <span class="mx-2">/</span>
        <a href="{{ route('shop.index', ['category' => $product->category->slug]) }}" class="hover:text-slate-700">
            {{ $product->category->name }}
        </a>
        <span class="mx-2">/</span>
        <span class="text-slate-700">{{ $product->name }}</span>
    </nav>

    <div class="grid gap-10 md:grid-cols-2">
        <div class="aspect-square overflow-hidden rounded-lg bg-slate-100">
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
        </div>

        <div>
            <p class="text-sm text-slate-500">{{ $product->brand }} &middot; {{ $product->category->name }}</p>
            <h1 class="mt-1 text-2xl font-semibold text-slate-900">{{ $product->name }}</h1>
            <p class="mt-1 text-xs text-slate-400">SKU: {{ $product->sku }}</p>

            <div class="mt-4 flex items-center gap-3">
                @if ($product->sale_price)
                    <span class="text-2xl font-semibold text-slate-900">{{ format_price($product->sale_price) }}</span>
                    <span class="text-lg text-slate-400 line-through">{{ format_price($product->price) }}</span>
                @else
                    <span class="text-2xl font-semibold text-slate-900">{{ format_price($product->price) }}</span>
                @endif
            </div>

            <p class="mt-4 text-sm text-slate-600">{{ $product->short_description }}</p>

            <p class="mt-4 text-sm">
                @if ($product->inStock())
                    <span class="font-medium text-green-700">In Stock</span>
                    <span class="text-slate-500">({{ $product->stock }} available)</span>
                @else
                    <span class="font-medium text-red-600">Out of Stock</span>
                @endif
            </p>

            @session('status')
                <div class="mt-4 rounded-md bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('status') }}</div>
            @endsession

            @session('error')
                <div class="mt-4 rounded-md bg-red-50 px-4 py-3 text-sm text-red-700">{{ session('error') }}</div>
            @endsession

            <form method="POST" action="{{ route('cart.store') }}" class="mt-6 flex items-center gap-3">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="flex items-center rounded-md border border-slate-300">
                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                           {{ $product->inStock() ? '' : 'disabled' }}
                           class="w-16 px-3 py-2 text-center text-sm">
                </div>

                @if ($product->inStock())
                    <button type="submit"
                            class="flex-1 rounded-md bg-slate-900 px-6 py-3 text-sm font-medium text-white hover:bg-slate-700">
                        Add to Cart
                    </button>
                @else
                    <button type="button" disabled
                            class="flex-1 cursor-not-allowed rounded-md bg-slate-300 px-6 py-3 text-sm font-medium text-slate-500">
                        Out of Stock
                    </button>
                @endif
            </form>

            @if ($product->specifications)
                <div class="mt-8">
                    <h2 class="mb-3 text-sm font-semibold text-slate-900">Specifications</h2>
                    <dl class="divide-y divide-slate-100 rounded-lg border border-slate-200 bg-white">
                        @foreach ($product->specifications as $key => $value)
                            <div class="flex justify-between px-4 py-2 text-sm">
                                <dt class="text-slate-500">{{ $key }}</dt>
                                <dd class="font-medium text-slate-900">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            @endif
        </div>
    </div>

    <div class="mt-12 max-w-3xl">
        <h2 class="mb-3 text-lg font-semibold text-slate-900">Description</h2>
        <p class="whitespace-pre-line text-sm leading-relaxed text-slate-600">{{ $product->description }}</p>
    </div>
</x-layout>
