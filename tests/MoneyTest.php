<?php declare(strict_types=1);

namespace App\Tests;

use App\Money;

/**
 * Class MoneyTest
 * @package App\Tests
 */
class MoneyTest extends \PHPUnit\Framework\TestCase
{
    public function testMultiplication(): void
    {
        $five = Money::dollar(5);
        $this->assertEquals(Money::dollar(10), $five->times(2));

        $this->assertEquals(Money::dollar(15), $five->times(3));
    }

    public function testEquality(): void
    {
        $this->assertTrue(Money::dollar(5)->equals(Money::dollar(5)));
        $this->assertFalse(Money::dollar(5)->equals(Money::dollar(6)));
        $this->assertFalse(Money::dollar(5)->equals(Money::franc(5)));
        $this->assertFalse(Money::dollar(5)->equals(new \ArrayObject([])));
    }

    public function testCurrency(): void
    {
        $this->assertEquals('USD', Money::dollar(1)->currency());
        $this->assertEquals('CHF', Money::franc(1)->currency());
    }

    public function testSimpleAddition(): void
    {
        $sum = Money::dollar(5)->plus(Money::dollar(5));
        $this->assertEquals(Money::dollar(10), $sum);
    }
}
