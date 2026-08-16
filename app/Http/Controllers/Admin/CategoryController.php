<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index(): View
    {
        $categories = Category::withCount('products')->orderBy('name')->paginate(15);

        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new category.
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category.
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? '' ?: Str::slug($data['name']);
        $data['status'] = $request->boolean('status');

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('status', 'Category created.');
    }

    /**
     * Show the form for editing a category.
     */
    public function edit(Category $category): View
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update a category.
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? '' ?: Str::slug($data['name']);
        $data['status'] = $request->boolean('status');

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('status', 'Category updated.');
    }

    /**
     * Delete a category, unless products still depend on it.
     */
    public function destroy(Category $category): RedirectResponse
    {
        if ($category->products()->exists()) {
            return back()->with('error', "\"{$category->name}\" has products assigned to it and can't be deleted. Reassign or remove those products first.");
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('status', 'Category deleted.');
    }

    /**
     * Toggle a category's active/inactive status.
     */
    public function toggleStatus(Category $category): RedirectResponse
    {
        $category->update(['status' => ! $category->status]);

        return back()->with('status', $category->status ? 'Category activated.' : 'Category deactivated.');
    }
}
