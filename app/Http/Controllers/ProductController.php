<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    /**
     * Display a single product.
     *
     * This is a minimal Phase 3 view so the Shop page's "View Product" links
     * resolve to a real page. Quantity selection and Add to Cart are wired up
     * in Phase 4 once the session cart exists.
     */
    public function show(Product $product): View
    {
        abort_unless($product->status, 404);

        return view('shop.show', [
            'product' => $product->load('category'),
        ]);
    }
}
