<x-layout title="Checkout">
    <h1 class="mb-6 text-2xl font-semibold text-slate-900">Checkout</h1>

    @if (! empty($notices))
        <div class="mb-6 space-y-2">
            @foreach ($notices as $notice)
                <div class="rounded-md bg-amber-50 px-4 py-3 text-sm text-amber-800">{{ $notice }}</div>
            @endforeach
        </div>
    @endif

    <div class="grid gap-10 lg:grid-cols-[1fr_360px]">
        <form method="POST" action="{{ route('checkout.store') }}" class="space-y-8">
            @csrf

            <section>
                <h2 class="mb-4 text-sm font-semibold uppercase tracking-wide text-slate-500">Customer Information</h2>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="name" class="mb-1 block text-sm font-medium text-slate-700">Full Name</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                               class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                               class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="mb-1 block text-sm font-medium text-slate-700">Phone</label>
                        <input id="phone" name="phone" type="text" value="{{ old('phone', $user->phone) }}" required
                               class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            <section>
                <h2 class="mb-4 text-sm font-semibold uppercase tracking-wide text-slate-500">Shipping Information</h2>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="address" class="mb-1 block text-sm font-medium text-slate-700">Address</label>
                        <input id="address" name="address" type="text" value="{{ old('address') }}" required
                               class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="city" class="mb-1 block text-sm font-medium text-slate-700">City</label>
                        <input id="city" name="city" type="text" value="{{ old('city') }}" required
                               class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
                        @error('city')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="state" class="mb-1 block text-sm font-medium text-slate-700">State / Province</label>
                        <input id="state" name="state" type="text" value="{{ old('state') }}" required
                               class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
                        @error('state')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="postal_code" class="mb-1 block text-sm font-medium text-slate-700">Postal Code</label>
                        <input id="postal_code" name="postal_code" type="text" value="{{ old('postal_code') }}" required
                               class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
                        @error('postal_code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="country" class="mb-1 block text-sm font-medium text-slate-700">Country</label>
                        <input id="country" name="country" type="text" value="{{ old('country') }}" required
                               class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
                        @error('country')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            <button type="submit"
                    class="w-full rounded-md bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-700 sm:w-auto">
                Place Order
            </button>
        </form>

        <aside class="h-fit rounded-lg border border-slate-200 bg-white p-6">
            <h2 class="mb-4 text-sm font-semibold uppercase tracking-wide text-slate-500">Order Summary</h2>

            <ul class="mb-4 space-y-3">
                @foreach ($items as $item)
                    <li class="flex justify-between text-sm">
                        <span class="text-slate-600">
                            {{ $item['product']->name }}
                            <span class="text-slate-400">&times; {{ $item['quantity'] }}</span>
                        </span>
                        <span class="font-medium text-slate-900">{{ format_price($item['lineTotal']) }}</span>
                    </li>
                @endforeach
            </ul>

            <div class="space-y-2 border-t border-slate-100 pt-4">
                <div class="flex justify-between text-sm text-slate-600">
                    <span>Subtotal</span>
                    <span>{{ format_price($subtotal) }}</span>
                </div>
                <div class="flex justify-between text-base font-semibold text-slate-900">
                    <span>Total</span>
                    <span>{{ format_price($subtotal) }}</span>
                </div>
            </div>
        </aside>
    </div>
</x-layout>
