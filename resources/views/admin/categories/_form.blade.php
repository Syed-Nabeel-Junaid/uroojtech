@php $category = $category ?? null; @endphp

<div class="grid gap-4">
    <div>
        <label for="name" class="mb-1 block text-sm font-medium text-slate-700">Name</label>
        <input id="name" name="name" type="text" value="{{ old('name', $category?->name) }}" required
               class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="slug" class="mb-1 block text-sm font-medium text-slate-700">Slug (optional — auto-generated from name)</label>
        <input id="slug" name="slug" type="text" value="{{ old('slug', $category?->slug) }}"
               class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">
        @error('slug')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="mb-1 block text-sm font-medium text-slate-700">Description</label>
        <textarea id="description" name="description" rows="3"
                  class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-300">{{ old('description', $category?->description) }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center gap-2">
        <input id="status" name="status" type="checkbox" value="1"
               {{ old('status', $category?->status ?? true) ? 'checked' : '' }}
               class="rounded border-slate-300">
        <label for="status" class="text-sm text-slate-700">Active</label>
    </div>
</div>

<button type="submit" class="mt-6 rounded-md bg-slate-900 px-5 py-2.5 text-sm font-medium text-white hover:bg-slate-700">
    {{ $category ? 'Update Category' : 'Create Category' }}
</button>
