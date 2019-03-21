<?php declare(strict_types=1);


namespace App;


/**
 * Class Money
 * @package App
 */
abstract class Money
{
    /**
     * @var int
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * Money constructor.
     * @param int $amount
     * @param string $currency
     */
    public function __construct(int $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @param int $amount
     * @return Dollar
     */
    public static function dollar(int $amount): Dollar
    {
        return new Dollar($amount, 'USD');
    }

    /**
     * @param int $amount
     * @return Franc
     */
    public static function franc(int $amount): Franc
    {
        return new Franc($amount, 'CHF');
    }

    /**
     * @param int $multiplier
     * @return Money
     */
    public function times(int $multiplier): Money
    {
        return new $this($this->amount * $multiplier, $this->currency);
    }

    /**
     * @return string
     */
    public function currency(): string
    {
        return $this->currency;
    }

    /**
     * @param $object
     * @return bool
     */
    public function equals($object): bool
    {
        if (!$object instanceof self) {
            return false;
        }

        return $this->amount === $object->amount && $this->currency() === $object->currency();
    }

    /**
     * @param Money $addend
     * @return Money
     */
    public function plus(Money $addend): Money
    {
        return new $this($this->amount + $addend->amount, $this->currency);
    }
}
