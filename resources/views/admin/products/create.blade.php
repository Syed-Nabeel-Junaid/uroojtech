<x-admin-layout title="Add Product">
    <div class="max-w-3xl rounded-lg border border-slate-200 bg-white p-6">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.products._form', ['product' => null, 'categories' => $categories])
        </form>
    </div>
</x-admin-layout>
