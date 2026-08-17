@props(['product'])

<div class="group @container flex flex-col overflow-hidden rounded-lg border border-slate-200 bg-white transition hover:border-slate-300 hover:shadow-sm">
    <a href="{{ route('shop.show', $product) }}" class="block aspect-square overflow-hidden bg-slate-100">
        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
             class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
    </a>

    <div class="flex flex-1 flex-col gap-2 p-4">
        <div class="flex items-center justify-between text-xs text-slate-500">
            <span>{{ $product->category->name }}</span>
            <span>{{ $product->brand }}</span>
        </div>

        <a href="{{ route('shop.show', $product) }}" class="text-sm font-medium text-slate-900 hover:underline">
            {{ $product->name }}
        </a>

        <div class="mt-auto flex items-center gap-2">
            @if ($product->sale_price)
                <span class="text-base font-semibold text-slate-900">{{ format_price($product->sale_price) }}</span>
                <span class="text-sm text-slate-400 line-through">{{ format_price($product->price) }}</span>
            @else
                <span class="text-base font-semibold text-slate-900">{{ format_price($product->price) }}</span>
            @endif
        </div>

        <div class="mt-2 grid grid-cols-1 items-stretch gap-2 @min-[250px]:grid-cols-2">
            <a href="{{ route('shop.show', $product) }}"
               class="flex items-center justify-center whitespace-nowrap rounded-md border border-slate-300 px-2.5 py-2 text-center text-sm font-medium text-slate-700 hover:border-slate-400">
                View Product
            </a>

            @if ($product->inStock())
                <form method="POST" action="{{ route('cart.store') }}" class="flex">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit"
                            class="flex w-full items-center justify-center whitespace-nowrap rounded-md border border-slate-900 bg-slate-900 px-2.5 py-2 text-center text-sm font-medium text-white hover:border-slate-700 hover:bg-slate-700">
                        Add to Cart
                    </button>
                </form>
            @else
                <button type="button" disabled
                        class="flex items-center justify-center whitespace-nowrap rounded-md border border-slate-300 bg-slate-300 px-2.5 py-2 text-center text-sm font-medium text-slate-500">
                    Out of Stock
                </button>
            @endif
        </div>
    </div>
</div>
