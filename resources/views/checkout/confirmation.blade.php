<x-layout title="Order Confirmed">
    <div class="mx-auto max-w-2xl text-center">
        <div class="mx-auto mb-6 flex h-14 w-14 items-center justify-center rounded-full bg-green-100 text-green-700">
            <span class="text-2xl">&#10003;</span>
        </div>

        <h1 class="text-2xl font-semibold text-slate-900">Thank you for your order</h1>
        <p class="mt-2 text-sm text-slate-600">
            Order <span class="font-medium text-slate-900">#{{ $confirmation['order_number'] }}</span>
            placed on {{ \Illuminate\Support\Carbon::parse($confirmation['placed_at'])->format('M j, Y \a\t g:i A') }}
        </p>

        <p class="mx-auto mt-4 max-w-md text-sm text-slate-500">
            This is a demo checkout — no payment was processed and no order has been saved
            to your account. A member of the Urooj Tech team would normally follow up to
            confirm shipping.
        </p>
    </div>

    <div class="mx-auto mt-10 grid max-w-2xl gap-6 sm:grid-cols-2">
        <div class="rounded-lg border border-slate-200 bg-white p-6">
            <h2 class="mb-3 text-sm font-semibold uppercase tracking-wide text-slate-500">Customer</h2>
            <dl class="space-y-1 text-sm text-slate-700">
                <div>{{ $confirmation['customer']['name'] }}</div>
                <div>{{ $confirmation['customer']['email'] }}</div>
                <div>{{ $confirmation['customer']['phone'] }}</div>
            </dl>
        </div>

        <div class="rounded-lg border border-slate-200 bg-white p-6">
            <h2 class="mb-3 text-sm font-semibold uppercase tracking-wide text-slate-500">Shipping Address</h2>
            <dl class="space-y-1 text-sm text-slate-700">
                <div>{{ $confirmation['shipping']['address'] }}</div>
                <div>
                    {{ $confirmation['shipping']['city'] }}, {{ $confirmation['shipping']['state'] }}
                    {{ $confirmation['shipping']['postal_code'] }}
                </div>
                <div>{{ $confirmation['shipping']['country'] }}</div>
            </dl>
        </div>
    </div>

    <div class="mx-auto mt-6 max-w-2xl rounded-lg border border-slate-200 bg-white p-6">
        <h2 class="mb-3 text-sm font-semibold uppercase tracking-wide text-slate-500">Order Summary</h2>
        <ul class="mb-4 space-y-2">
            @foreach ($confirmation['items'] as $item)
                <li class="flex justify-between text-sm">
                    <span class="text-slate-600">{{ $item['name'] }} &times; {{ $item['quantity'] }}</span>
                    <span class="font-medium text-slate-900">{{ format_price($item['lineTotal']) }}</span>
                </li>
            @endforeach
        </ul>
        <div class="flex justify-between border-t border-slate-100 pt-3 text-base font-semibold text-slate-900">
            <span>Total</span>
            <span>{{ format_price($confirmation['total']) }}</span>
        </div>
    </div>

    <div class="mx-auto mt-10 max-w-2xl text-center">
        <a href="{{ route('shop.index') }}"
           class="inline-block rounded-md bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-700">
            Continue Shopping
        </a>
    </div>
</x-layout>
