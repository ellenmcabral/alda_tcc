<?php

namespace Tests\Unit;

use App\Models\Shop;
use PHPUnit\Framework\TestCase;

class ShopTest extends TestCase
{
    protected Shop $shop;

    public function setUp(): void
    {
        $this->shop = new Shop([
            'url' => 'lojateste',
            'image' => '1.jpg',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function test_shop_url_can_be_formatted(): void
    {
        $this->assertEquals('@lojateste', $this->shop->formatUrl());
    }

    public function test_shop_date_can_be_formatted(): void
    {
        $this->assertEquals(date('d/m/Y'), $this->shop->formatDate());
    }

    public function test_shop_image_path_can_be_formatted(): void
    {
        $this->assertEquals('/img/shops/' . $this->shop->image, $this->shop->getImagePath());
    }
}
