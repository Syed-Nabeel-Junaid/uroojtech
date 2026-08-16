<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $productId = $this->route('product')->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($productId)],
            'sku' => ['required', 'string', 'max:100', Rule::unique('products', 'sku')->ignore($productId)],
            'category_id' => ['required', 'exists:categories,id'],
            'brand' => ['required', 'string', 'max:100'],
            'price' => ['required', 'numeric', 'min:0'],
            'sale_price' => ['nullable', 'numeric', 'min:0', 'lt:price'],
            'short_description' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'specifications' => ['nullable', 'string'],
            'stock' => ['required', 'integer', 'min:0'],
            'status' => ['boolean'],
            'featured' => ['boolean'],
            'image' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
