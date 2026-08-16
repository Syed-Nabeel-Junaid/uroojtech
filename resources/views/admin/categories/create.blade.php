<x-admin-layout title="Add Category">
    <div class="max-w-xl rounded-lg border border-slate-200 bg-white p-6">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            @include('admin.categories._form', ['category' => null])
        </form>
    </div>
</x-admin-layout>
