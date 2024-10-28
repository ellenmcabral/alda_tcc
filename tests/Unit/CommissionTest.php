<?php

namespace Tests\Unit;

use App\Models\Commission;
use PHPUnit\Framework\TestCase;

class CommissionTest extends TestCase
{
    protected Commission $commission;

    public function setUp(): void
    {
        $this->commission = new Commission([
            'total' => 59,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function test_commission_date_can_be_formatted(): void
    {
        $this->assertEquals(date('d/m/Y'), $this->commission->formatDate());
    }

    public function test_commission_price_can_be_formatted(): void
    {
        $this->assertEquals('R$ 59,00', $this->commission->formatPrice());
    }
}
