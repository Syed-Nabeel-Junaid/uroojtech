@php $product = $product ?? null; @endphp

<div class="grid gap-4 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <label for="name" class="mb-1 block text-sm font-medium text-slate-700">Name</label>
        <input id="name" name="name" type="text" value="{{ old('name', $product?->name) }}" required
               class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="slug" class="mb-1 block text-sm font-medium text-slate-700">Slug (optional — auto-generated from name)</label>
        <input id="slug" name="slug" type="text" value="{{ old('slug', $product?->slug) }}"
               class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
        @error('slug')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="sku" class="mb-1 block text-sm font-medium text-slate-700">SKU</label>
        <input id="sku" name="sku" type="text" value="{{ old('sku', $product?->sku) }}" required
               class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
        @error('sku')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="category_id" class="mb-1 block text-sm font-medium text-slate-700">Category</label>
        <select id="category_id" name="category_id" required
                class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
            <option value="">Select a category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ (int) old('category_id', $product?->category_id) === $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="brand" class="mb-1 block text-sm font-medium text-slate-700">Brand</label>
        <input id="brand" name="brand" type="text" value="{{ old('brand', $product?->brand) }}" required
               class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
        @error('brand')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="stock" class="mb-1 block text-sm font-medium text-slate-700">Stock</label>
        <input id="stock" name="stock" type="number" min="0" value="{{ old('stock', $product?->stock ?? 0) }}" required
               class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
        @error('stock')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="price" class="mb-1 block text-sm font-medium text-slate-700">Price</label>
        <input id="price" name="price" type="number" step="0.01" min="0" value="{{ old('price', $product?->price) }}" required
               class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
        @error('price')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="sale_price" class="mb-1 block text-sm font-medium text-slate-700">Sale Price (optional)</label>
        <input id="sale_price" name="sale_price" type="number" step="0.01" min="0" value="{{ old('sale_price', $product?->sale_price) }}"
               class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
        @error('sale_price')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="sm:col-span-2">
        <label for="short_description" class="mb-1 block text-sm font-medium text-slate-700">Short Description</label>
        <input id="short_description" name="short_description" type="text"
               value="{{ old('short_description', $product?->short_description) }}" required
               class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
        @error('short_description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="sm:col-span-2">
        <label for="description" class="mb-1 block text-sm font-medium text-slate-700">Full Description</label>
        <textarea id="description" name="description" rows="5" required
                  class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">{{ old('description', $product?->description) }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="sm:col-span-2">
        <label for="specifications" class="mb-1 block text-sm font-medium text-slate-700">
            Specifications (one per line, "Key: Value")
        </label>
        <textarea id="specifications" name="specifications" rows="4" placeholder="RAM: 16GB&#10;Storage: 512GB SSD"
                  class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">{{ old('specifications', $specificationsText ?? '') }}</textarea>
        @error('specifications')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="sm:col-span-2">
        <label for="image" class="mb-1 block text-sm font-medium text-slate-700">
            Product Image {{ $product ? '(leave blank to keep current image)' : '(optional — a placeholder is used if omitted)' }}
        </label>
        <input id="image" name="image" type="file" accept="image/*"
               class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">
        @error('image')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror

        @if ($product?->image)
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="mt-2 h-20 w-20 rounded-md object-cover">
        @endif
    </div>

    <div class="flex items-center gap-2">
        <input id="status" name="status" type="checkbox" value="1"
               {{ old('status', $product?->status ?? true) ? 'checked' : '' }}
               class="rounded border-slate-300">
        <label for="status" class="text-sm text-slate-700">Active</label>
    </div>

    <div class="flex items-center gap-2">
        <input id="featured" name="featured" type="checkbox" value="1"
               {{ old('featured', $product?->featured ?? false) ? 'checked' : '' }}
               class="rounded border-slate-300">
        <label for="featured" class="text-sm text-slate-700">Featured</label>
    </div>
</div>

<button type="submit" class="mt-6 rounded-md bg-slate-900 px-5 py-2.5 text-sm font-medium text-white hover:bg-slate-700">
    {{ $product ? 'Update Product' : 'Create Product' }}
</button>
