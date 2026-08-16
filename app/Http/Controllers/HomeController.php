<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Display the storefront homepage.
     */
    public function index(): View
    {
        $featuredProducts = Product::query()
            ->where('status', true)
            ->where('featured', true)
            ->with('category')
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::query()
            ->where('status', true)
            ->withCount('products')
            ->orderBy('name')
            ->get();

        return view('home', [
            'featuredProducts' => $featuredProducts,
            'categories' => $categories,
        ]);
    }
}
