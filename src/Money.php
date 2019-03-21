<?php declare(strict_types=1);


namespace App;


/**
 * Class Money
 * @package App
 */
abstract class Money implements Expression
{
    /**
     * @var int
     */
    public $amount;

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

    public static function createFromCurrency(int $amount, string $currency): Money
    {
        switch ($currency) {
            case 'USD':
                return self::dollar($amount);
            case 'CHF':
                return self::franc($amount);
        }
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
     * @return Expression
     */
    public function plus(Money $addend): Expression
    {
        return new Sum($this, $addend);
    }

    /**
     * @param Bank $bank
     * @param string $to
     * @return Money
     */
    public function reduce(Bank $bank, string $to): Money
    {
        $rate = $bank->rate($this->currency, $to);
        return self::createFromCurrency($this->amount / $rate, $to);
    }
}
