<x-admin-layout title="Categories">
    @session('status')
        <div class="mb-6 rounded-md bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('status') }}</div>
    @endsession

    @session('error')
        <div class="mb-6 rounded-md bg-red-50 px-4 py-3 text-sm text-red-700">{{ session('error') }}</div>
    @endsession

    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-slate-600">{{ $categories->total() }} categories</p>
        <a href="{{ route('admin.categories.create') }}"
           class="rounded-md bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-700">
            + Add Category
        </a>
    </div>

    <div class="overflow-x-auto rounded-lg border border-slate-200 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-slate-200 bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Products</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($categories as $category)
                    <tr>
                        <td class="px-4 py-3">
                            <p class="font-medium text-slate-900">{{ $category->name }}</p>
                            <p class="text-xs text-slate-500">{{ $category->slug }}</p>
                        </td>
                        <td class="px-4 py-3 text-slate-600">{{ $category->products_count }}</td>
                        <td class="px-4 py-3">
                            <form method="POST" action="{{ route('admin.categories.toggle-status', $category) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="rounded-full px-2 py-1 text-xs font-medium {{ $category->status ? 'bg-green-100 text-green-700' : 'bg-slate-200 text-slate-600' }}">
                                    {{ $category->status ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="text-slate-600 hover:text-slate-900">Edit</a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                      onsubmit="return confirm('Delete this category?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-sm text-slate-500">No categories yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $categories->links() }}</div>
</x-admin-layout>
