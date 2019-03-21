<?php declare(strict_types=1);

namespace App\Tests;

use App\Bank;
use App\Money;
use App\Sum;

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
        $five = Money::dollar(5);
        $sum = $five->plus($five);
        $bank = new Bank();
        $reduced = $bank->reduce($sum, 'USD');
        $this->assertEquals(Money::dollar(10), $reduced);
    }

    public function testPlusReturnsSum(): void
    {
        $five = Money::dollar(5);
        /** @var Sum $result */
        $result = $five->plus($five);

        $this->assertEquals($five, $result->augend);
        $this->assertEquals($five, $result->addend);
    }

    public function testReduceSum(): void
    {
        $sum = new Sum(Money::dollar(3), Money::dollar(4));
        $bank = new Bank();
        $result = $bank->reduce($sum, 'USD');
        $this->assertEquals(Money::dollar(7), $result);
    }
}
