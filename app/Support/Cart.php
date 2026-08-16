<?php

namespace App\Support;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

/**
 * Session-based shopping cart.
 *
 * The session only stores {product_id => quantity}. Price, stock, and
 * availability are always re-read from the database on access so the cart
 * never trusts stale data — see items().
 */
class Cart
{
    protected const SESSION_KEY = 'cart';

    /**
     * Add a product to the cart, clamped to available stock.
     *
     * @return array{added: bool, message: string}
     */
    public function add(int $productId, int $quantity): array
    {
        $product = Product::find($productId);

        if (! $product || ! $product->status) {
            return ['added' => false, 'message' => 'That product is no longer available.'];
        }

        if ($quantity < 1) {
            return ['added' => false, 'message' => 'Please choose a valid quantity.'];
        }

        if ($product->stock < 1) {
            return ['added' => false, 'message' => 'That product is currently out of stock.'];
        }

        $cart = $this->raw();
        $existingQuantity = $cart[$productId] ?? 0;
        $requestedQuantity = $existingQuantity + $quantity;
        $newQuantity = min($requestedQuantity, $product->stock);
        $cart[$productId] = $newQuantity;
        $this->save($cart);

        $message = $newQuantity < $requestedQuantity
            ? "Added {$product->name} to your cart (quantity limited to available stock)."
            : "{$product->name} was added to your cart.";

        return ['added' => true, 'message' => $message];
    }

    /**
     * Update the quantity for a product already in the cart, clamped to stock.
     * A quantity of 0 or less removes the item.
     *
     * @return array{updated: bool, message: string}
     */
    public function update(int $productId, int $quantity): array
    {
        $cart = $this->raw();

        if (! array_key_exists($productId, $cart)) {
            return ['updated' => false, 'message' => 'That item is not in your cart.'];
        }

        if ($quantity < 1) {
            unset($cart[$productId]);
            $this->save($cart);

            return ['updated' => true, 'message' => 'Item removed from your cart.'];
        }

        $product = Product::find($productId);

        if (! $product || ! $product->status) {
            unset($cart[$productId]);
            $this->save($cart);

            return ['updated' => false, 'message' => 'That product is no longer available and was removed.'];
        }

        $cart[$productId] = min($quantity, $product->stock);
        $this->save($cart);

        return ['updated' => true, 'message' => 'Cart updated.'];
    }

    /**
     * Remove a product from the cart.
     */
    public function remove(int $productId): void
    {
        $cart = $this->raw();
        unset($cart[$productId]);
        $this->save($cart);
    }

    /**
     * Empty the cart.
     */
    public function clear(): void
    {
        Session::forget(self::SESSION_KEY);
    }

    /**
     * Resolved cart line items, validated against live product data.
     * Any items that are invalid, unavailable, or over stock are corrected
     * and persisted back to the session, with a human-readable note for each.
     *
     * @return array{items: Collection<int, array{product: Product, quantity: int, lineTotal: float}>, notices: array<int, string>}
     */
    public function items(): array
    {
        $cart = $this->raw();
        $notices = [];
        $items = collect();

        $products = Product::whereIn('id', array_keys($cart))->get()->keyBy('id');

        foreach ($cart as $productId => $quantity) {
            $product = $products->get($productId);

            if (! $product || ! $product->status) {
                unset($cart[$productId]);
                $notices[] = 'An item in your cart is no longer available and was removed.';

                continue;
            }

            if ($product->stock < 1) {
                unset($cart[$productId]);
                $notices[] = "{$product->name} is out of stock and was removed from your cart.";

                continue;
            }

            $effectiveQuantity = min($quantity, $product->stock);

            if ($effectiveQuantity !== $quantity) {
                $notices[] = "Quantity for {$product->name} was reduced to match available stock ({$product->stock}).";
            }

            $cart[$productId] = $effectiveQuantity;

            $unitPrice = $product->sale_price ?? $product->price;

            $items->push([
                'product' => $product,
                'quantity' => $effectiveQuantity,
                'lineTotal' => round($unitPrice * $effectiveQuantity, 2),
            ]);
        }

        $this->save($cart);

        return ['items' => $items, 'notices' => $notices];
    }

    /**
     * Total quantity of items in the cart, for the nav badge.
     */
    public function count(): int
    {
        return array_sum($this->raw());
    }

    /**
     * Cart subtotal (sum of line totals). No tax/shipping in this MVP.
     */
    public function subtotal(): float
    {
        return round($this->items()['items']->sum('lineTotal'), 2);
    }

    /**
     * Raw {product_id => quantity} map from the session.
     *
     * @return array<int, int>
     */
    protected function raw(): array
    {
        return Session::get(self::SESSION_KEY, []);
    }

    /**
     * Persist the raw cart map to the session.
     *
     * @param  array<int, int>  $cart
     */
    protected function save(array $cart): void
    {
        Session::put(self::SESSION_KEY, $cart);
    }
}
