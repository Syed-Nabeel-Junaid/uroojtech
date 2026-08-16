<x-admin-layout title="Edit Category">
    <div class="max-w-xl rounded-lg border border-slate-200 bg-white p-6">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf
            @method('PUT')
            @include('admin.categories._form', ['category' => $category])
        </form>
    </div>
</x-admin-layout>
