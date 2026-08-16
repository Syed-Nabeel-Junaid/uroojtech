<x-admin-layout title="Edit Product">
    <div class="max-w-3xl rounded-lg border border-slate-200 bg-white p-6">
        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.products._form', ['product' => $product, 'categories' => $categories, 'specificationsText' => $specificationsText])
        </form>
    </div>
</x-admin-layout>
