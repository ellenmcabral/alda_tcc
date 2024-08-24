<?php

namespace Tests\Unit;

use App\Models\Product;
use PHPUnit\Framework\TestCase;

class ProductPriceFormatTest extends TestCase
{

    public function test_product_price_can_be_formatted(): void
    {
        $product = new Product([
            'name' => 'Produto Teste',
            'sale_price' => 59,
        ]);

        $this->assertEquals('R$ 59,00', $product->priceFormat());
    }
}
