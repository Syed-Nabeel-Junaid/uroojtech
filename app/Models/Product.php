<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'sku',
        'category_id',
        'brand',
        'price',
        'sale_price',
        'short_description',
        'description',
        'specifications',
        'stock',
        'status',
        'featured',
        'image',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'sale_price' => 'decimal:2',
            'specifications' => 'array',
            'stock' => 'integer',
            'status' => 'boolean',
            'featured' => 'boolean',
        ];
    }

    /**
     * The category this product belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Whether the product is in stock.
     */
    public function inStock(): bool
    {
        return $this->stock > 0;
    }
}
