<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Requests\Cart\UpdateCartRequest;
use App\Models\Product;
use App\Support\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    public function __construct(protected Cart $cart) {}

    /**
     * Display the cart contents.
     */
    public function index(): View
    {
        $result = $this->cart->items();

        return view('cart.index', [
            'items' => $result['items'],
            'notices' => $result['notices'],
            'subtotal' => round($result['items']->sum('lineTotal'), 2),
        ]);
    }

    /**
     * Add a product to the cart.
     */
    public function store(AddToCartRequest $request): RedirectResponse
    {
        $result = $this->cart->add(
            (int) $request->input('product_id'),
            (int) $request->input('quantity')
        );

        return back()->with($result['added'] ? 'status' : 'error', $result['message']);
    }

    /**
     * Update the quantity for a product in the cart.
     */
    public function update(UpdateCartRequest $request, Product $product): RedirectResponse
    {
        $result = $this->cart->update($product->id, (int) $request->input('quantity'));

        return back()->with($result['updated'] ? 'status' : 'error', $result['message']);
    }

    /**
     * Remove a product from the cart.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $this->cart->remove($product->id);

        return back()->with('status', 'Item removed from your cart.');
    }
}
