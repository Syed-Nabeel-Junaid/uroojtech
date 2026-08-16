<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(): View
    {
        $products = Product::with('category')->latest()->paginate(15);

        return view('admin.products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        return view('admin.products.create', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created product.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? '' ?: Str::slug($data['name']);
        $data['specifications'] = $this->parseSpecifications($request->input('specifications'));
        $data['status'] = $request->boolean('status');
        $data['featured'] = $request->boolean('featured');
        $data['image'] = $this->storeImage($request) ?? 'images/products/placeholder.svg';

        Product::create($data);

        return redirect()->route('admin.products.index')->with('status', 'Product created.');
    }

    /**
     * Show the form for editing a product.
     */
    public function edit(Product $product): View
    {
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::orderBy('name')->get(),
            'specificationsText' => $this->formatSpecifications($product->specifications),
        ]);
    }

    /**
     * Update a product.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? '' ?: Str::slug($data['name']);
        $data['specifications'] = $this->parseSpecifications($request->input('specifications'));
        $data['status'] = $request->boolean('status');
        $data['featured'] = $request->boolean('featured');

        if ($uploaded = $this->storeImage($request)) {
            $data['image'] = $uploaded;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('status', 'Product updated.');
    }

    /**
     * Delete a product.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('status', 'Product deleted.');
    }

    /**
     * Toggle a product's active/inactive status.
     */
    public function toggleStatus(Product $product): RedirectResponse
    {
        $product->update(['status' => ! $product->status]);

        return back()->with('status', $product->status ? 'Product activated.' : 'Product deactivated.');
    }

    /**
     * Toggle a product's featured flag.
     */
    public function toggleFeatured(Product $product): RedirectResponse
    {
        $product->update(['featured' => ! $product->featured]);

        return back()->with('status', $product->featured ? 'Product marked as featured.' : 'Product removed from featured.');
    }

    /**
     * Store an uploaded product image on the public disk, if one was provided.
     */
    protected function storeImage(Request $request): ?string
    {
        if (! $request->hasFile('image')) {
            return null;
        }

        $path = $request->file('image')->store('products', 'public');

        return 'storage/'.$path;
    }

    /**
     * Parse a "Key: Value" per-line textarea into an associative array.
     */
    protected function parseSpecifications(?string $raw): ?array
    {
        if (! $raw || trim($raw) === '') {
            return null;
        }

        $specs = [];

        foreach (explode("\n", $raw) as $line) {
            $line = trim($line);

            if ($line === '' || ! str_contains($line, ':')) {
                continue;
            }

            [$key, $value] = explode(':', $line, 2);
            $key = trim($key);
            $value = trim($value);

            if ($key !== '' && $value !== '') {
                $specs[$key] = $value;
            }
        }

        return $specs ?: null;
    }

    /**
     * Format a specifications array back into "Key: Value" lines for the edit form.
     */
    protected function formatSpecifications(?array $specifications): string
    {
        if (! $specifications) {
            return '';
        }

        $lines = [];

        foreach ($specifications as $key => $value) {
            $lines[] = "{$key}: {$value}";
        }

        return implode("\n", $lines);
    }
}
