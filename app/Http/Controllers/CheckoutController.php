<?php

namespace App\Http\Controllers;

use App\Http\Requests\Checkout\PlaceOrderRequest;
use App\Support\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function __construct(protected Cart $cart) {}

    /**
     * Display the checkout form.
     */
    public function index(Request $request): View|RedirectResponse
    {
        $result = $this->cart->items();

        if ($result['items']->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty. Add a product before checking out.');
        }

        $user = $request->user();

        return view('checkout.index', [
            'items' => $result['items'],
            'notices' => $result['notices'],
            'subtotal' => round($result['items']->sum('lineTotal'), 2),
            'user' => $user,
        ]);
    }

    /**
     * Place the order.
     *
     * No payment processing or persistent order record exists in this MVP —
     * placing an order simply confirms the details, clears the cart, and shows
     * a one-time confirmation summary flashed to the session.
     */
    public function store(PlaceOrderRequest $request): RedirectResponse
    {
        $result = $this->cart->items();

        if ($result['items']->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty. Add a product before checking out.');
        }

        $subtotal = round($result['items']->sum('lineTotal'), 2);

        $confirmation = [
            'order_number' => strtoupper(Str::random(8)),
            'placed_at' => now()->toDateTimeString(),
            'customer' => $request->only('name', 'email', 'phone'),
            'shipping' => $request->only('address', 'city', 'state', 'postal_code', 'country'),
            'items' => $result['items']->map(fn ($item) => [
                'name' => $item['product']->name,
                'quantity' => $item['quantity'],
                'lineTotal' => $item['lineTotal'],
            ])->all(),
            'subtotal' => $subtotal,
            'total' => $subtotal,
        ];

        $this->cart->clear();

        return redirect()
            ->route('checkout.confirmation')
            ->with('checkout_confirmation', $confirmation);
    }

    /**
     * Display the one-time order confirmation.
     */
    public function confirmation(Request $request): View|RedirectResponse
    {
        $confirmation = $request->session()->get('checkout_confirmation');

        if (! $confirmation) {
            return redirect()->route('shop.index');
        }

        return view('checkout.confirmation', ['confirmation' => $confirmation]);
    }
}
