<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display the shop / product listing page.
     */
    public function index(Request $request): View
    {
        $query = Product::query()->where('status', true)->with('category');

        if ($request->filled('category')) {
            $categorySlug = $request->string('category')->toString();
            $query->whereHas('category', fn ($q) => $q->where('slug', $categorySlug));
        }

        if ($request->filled('brand')) {
            $query->where('brand', $request->string('brand')->toString());
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float) $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->input('max_price'));
        }

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%");
            });
        }

        match ($request->string('sort')->toString()) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            default => $query->latest(),
        };

        $products = $query->paginate(12)->withQueryString();

        $categories = Category::where('status', true)->orderBy('name')->get();

        $brands = Product::where('status', true)
            ->select('brand')
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand');

        return view('shop.index', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }
}
