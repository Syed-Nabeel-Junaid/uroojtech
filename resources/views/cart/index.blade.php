<x-layout title="Your Cart">
    <h1 class="mb-6 text-2xl font-semibold text-slate-900">Your Cart</h1>

    @if (! empty($notices))
        <div class="mb-6 space-y-2">
            @foreach ($notices as $notice)
                <div class="rounded-md bg-amber-50 px-4 py-3 text-sm text-amber-800">{{ $notice }}</div>
            @endforeach
        </div>
    @endif

    @session('status')
        <div class="mb-6 rounded-md bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('status') }}</div>
    @endsession

    @session('error')
        <div class="mb-6 rounded-md bg-red-50 px-4 py-3 text-sm text-red-700">{{ session('error') }}</div>
    @endsession

    @if ($items->isEmpty())
        <div class="rounded-lg border border-dashed border-slate-300 bg-white p-12 text-center">
            <p class="text-sm text-slate-500">Your cart is empty.</p>
            <a href="{{ route('shop.index') }}"
               class="mt-4 inline-block rounded-md bg-slate-900 px-5 py-2.5 text-sm font-medium text-white hover:bg-slate-700">
                Continue Shopping
            </a>
        </div>
    @else
        <div class="overflow-x-auto rounded-lg border border-slate-200 bg-white">
            <table class="w-full min-w-[560px] text-left text-sm">
                <thead class="border-b border-slate-200 bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-4 py-3">Product</th>
                        <th class="px-4 py-3">Price</th>
                        <th class="px-4 py-3">Quantity</th>
                        <th class="px-4 py-3">Line Total</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($items as $item)
                        @php $product = $item['product']; @endphp
                        <tr>
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                         class="h-14 w-14 rounded-md object-cover">
                                    <div>
                                        <a href="{{ route('shop.show', $product) }}"
                                           class="font-medium text-slate-900 hover:underline">{{ $product->name }}</a>
                                        <p class="text-xs text-slate-500">{{ $product->brand }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-slate-700">
                                ${{ number_format($product->sale_price ?? $product->price, 2) }}
                            </td>
                            <td class="px-4 py-4">
                                <form method="POST" action="{{ route('cart.update', $product) }}" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                           min="1" max="{{ $product->stock }}"
                                           class="w-16 rounded-md border border-slate-300 px-2 py-1 text-sm">
                                    <button type="submit"
                                            class="rounded-md border border-slate-300 px-2 py-1 text-xs font-medium text-slate-600 hover:border-slate-400">
                                        Update
                                    </button>
                                </form>
                            </td>
                            <td class="px-4 py-4 font-medium text-slate-900">${{ number_format($item['lineTotal'], 2) }}</td>
                            <td class="px-4 py-4 text-right">
                                <form method="POST" action="{{ route('cart.destroy', $product) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:underline">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8 flex justify-end">
            <div class="w-full max-w-sm space-y-3 rounded-lg border border-slate-200 bg-white p-6">
                <div class="flex justify-between text-sm text-slate-600">
                    <span>Subtotal</span>
                    <span>${{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="flex justify-between border-t border-slate-100 pt-3 text-base font-semibold text-slate-900">
                    <span>Total</span>
                    <span>${{ number_format($subtotal, 2) }}</span>
                </div>

                <a href="{{ route('checkout.index') }}"
                   class="block w-full rounded-md bg-slate-900 px-4 py-3 text-center text-sm font-medium text-white hover:bg-slate-700">
                    Proceed to Checkout
                </a>

                <a href="{{ route('shop.index') }}"
                   class="block text-center text-sm font-medium text-slate-600 hover:text-slate-900">
                    Continue Shopping
                </a>
            </div>
        </div>
    @endif
</x-layout>
