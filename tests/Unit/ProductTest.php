<?php

namespace Tests\Unit;

use App\Models\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    protected Product $product;

    public function setUp(): void
    {
        $this->product = new Product([
            'name' => 'Produto Teste',
            'sale_price' => 59,
            'image' => '1.jpg',
        ]);
    }

    public function test_product_price_can_be_formatted(): void
    {
        $this->assertEquals('R$ 59,00', $this->product->formatPrice());
    }

    public function test_product_image_path_can_be_formatted(): void
    {
        $this->assertEquals('/img/products/' . $this->product->image, $this->product->getImagePath());
    }

    public function test_product_default_image_path_if_product_image_is_null(): void
    {
        $product = new Product([
            'name' => 'Produto Teste',
        ]);

        $this->assertEquals(null, $product->image);
        $this->assertEquals('/img/products/no-image.jpg', $product->getImagePath());
    }
}
