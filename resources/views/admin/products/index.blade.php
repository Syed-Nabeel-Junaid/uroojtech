<x-admin-layout title="Products">
    @session('status')
        <div class="mb-6 rounded-md bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('status') }}</div>
    @endsession

    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-slate-600">{{ $products->total() }} products</p>
        <a href="{{ route('admin.products.create') }}"
           class="rounded-md bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-700">
            + Add Product
        </a>
    </div>

    <div class="overflow-x-auto rounded-lg border border-slate-200 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-slate-200 bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="px-4 py-3">Product</th>
                    <th class="px-4 py-3">Category</th>
                    <th class="px-4 py-3">Price</th>
                    <th class="px-4 py-3">Stock</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Featured</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($products as $product)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset($product->image) }}" alt="" class="h-10 w-10 rounded object-cover">
                                <div>
                                    <p class="font-medium text-slate-900">{{ $product->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $product->sku }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-slate-600">{{ $product->category->name }}</td>
                        <td class="px-4 py-3 text-slate-600">
                            ${{ number_format($product->sale_price ?? $product->price, 2) }}
                        </td>
                        <td class="px-4 py-3 text-slate-600">{{ $product->stock }}</td>
                        <td class="px-4 py-3">
                            <form method="POST" action="{{ route('admin.products.toggle-status', $product) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="rounded-full px-2 py-1 text-xs font-medium {{ $product->status ? 'bg-green-100 text-green-700' : 'bg-slate-200 text-slate-600' }}">
                                    {{ $product->status ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </td>
                        <td class="px-4 py-3">
                            <form method="POST" action="{{ route('admin.products.toggle-featured', $product) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="rounded-full px-2 py-1 text-xs font-medium {{ $product->featured ? 'bg-amber-100 text-amber-700' : 'bg-slate-200 text-slate-600' }}">
                                    {{ $product->featured ? 'Featured' : 'Not Featured' }}
                                </button>
                            </form>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('admin.products.edit', $product) }}" class="text-slate-600 hover:text-slate-900">Edit</a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                      onsubmit="return confirm('Delete this product? This cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-sm text-slate-500">No products yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $products->links() }}</div>
</x-admin-layout>
