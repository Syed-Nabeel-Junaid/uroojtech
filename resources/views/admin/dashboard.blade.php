<x-admin-layout title="Dashboard">
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <a href="{{ route('admin.products.index') }}" class="rounded-lg border border-slate-200 bg-white p-6 hover:border-slate-300">
            <p class="text-sm text-slate-500">Total Products</p>
            <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $totalProducts }}</p>
        </a>

        <a href="{{ route('admin.categories.index') }}" class="rounded-lg border border-slate-200 bg-white p-6 hover:border-slate-300">
            <p class="text-sm text-slate-500">Total Categories</p>
            <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $totalCategories }}</p>
        </a>

        <a href="{{ route('admin.customers.index') }}" class="rounded-lg border border-slate-200 bg-white p-6 hover:border-slate-300">
            <p class="text-sm text-slate-500">Total Customers</p>
            <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $totalCustomers }}</p>
        </a>

        <div class="rounded-lg border border-slate-200 bg-white p-6">
            <p class="text-sm text-slate-500">Featured Products</p>
            <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $featuredProducts }}</p>
        </div>
    </div>

    <div class="mt-8 grid gap-4 sm:grid-cols-3">
        <a href="{{ route('admin.products.create') }}"
           class="rounded-lg border border-dashed border-slate-300 bg-white p-6 text-center text-sm font-medium text-slate-700 hover:border-slate-400">
            + Add Product
        </a>
        <a href="{{ route('admin.categories.create') }}"
           class="rounded-lg border border-dashed border-slate-300 bg-white p-6 text-center text-sm font-medium text-slate-700 hover:border-slate-400">
            + Add Category
        </a>
        <a href="{{ route('admin.customers.index') }}"
           class="rounded-lg border border-dashed border-slate-300 bg-white p-6 text-center text-sm font-medium text-slate-700 hover:border-slate-400">
            View Customers
        </a>
    </div>
</x-admin-layout>
