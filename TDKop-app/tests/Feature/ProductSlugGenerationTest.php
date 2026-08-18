<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductSlugGenerationTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_slug_is_generated_automatically_when_missing(): void
    {
        Category::create([
            'name' => 'Seragam',
            'slug' => 'seragam',
        ]);

        $product = Product::create([
            'category_id' => 1,
            'name' => 'Almameter',
            'price' => 150000,
            'description' => 'keren',
            'image' => null,
        ]);

        $this->assertSame('almameter', $product->slug);
        $this->assertDatabaseHas('products', ['slug' => 'almameter']);
    }
}
