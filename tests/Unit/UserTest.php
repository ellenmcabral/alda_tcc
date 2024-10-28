<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_user_name_can_be_formatted(): void
    {
        $user = new User([
            'name' => 'Ellen Morales',
        ]);

        $this->assertEquals('Ellen', $user->formatName());
    }
}
