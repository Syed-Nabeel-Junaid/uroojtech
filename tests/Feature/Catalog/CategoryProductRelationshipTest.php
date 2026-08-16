<?php

namespace Tests\Feature\Catalog;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryProductRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_product_belongs_to_a_category(): void
    {
        $category = Category::factory()->create(['name' => 'Laptops']);
        $product = Product::factory()->create(['category_id' => $category->id]);

        $this->assertTrue($product->category->is($category));
    }

    public function test_a_category_has_many_products(): void
    {
        $category = Category::factory()->create();
        Product::factory()->count(3)->create(['category_id' => $category->id]);

        $this->assertCount(3, $category->products);
    }

    public function test_specifications_are_cast_to_an_array(): void
    {
        $product = Product::factory()->create([
            'specifications' => ['RAM' => '16GB', 'Storage' => '512GB SSD'],
        ]);

        $this->assertIsArray($product->fresh()->specifications);
        $this->assertSame('16GB', $product->fresh()->specifications['RAM']);
    }

    public function test_in_stock_reflects_stock_quantity(): void
    {
        $inStock = Product::factory()->create(['stock' => 5]);
        $outOfStock = Product::factory()->create(['stock' => 0]);

        $this->assertTrue($inStock->inStock());
        $this->assertFalse($outOfStock->inStock());
    }

    public function test_a_category_with_products_cannot_be_deleted(): void
    {
        $category = Category::factory()->create();
        Product::factory()->create(['category_id' => $category->id]);

        $this->expectException(QueryException::class);

        $category->delete();
    }

    public function test_a_category_without_products_can_be_deleted(): void
    {
        $category = Category::factory()->create();

        $category->delete();

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
