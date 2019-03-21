<?php declare(strict_types=1);


namespace App;


/**
 * Class Sum
 * @package App
 */
class Sum implements Expression
{
    /**
     * @var Money
     */
    public $augend;

    /**
     * @var Money
     */
    public $addend;

    /**
     * Sum constructor.
     * @param Money $augend
     * @param Money $addend
     */
    public function __construct(Money $augend, Money $addend)
    {
        $this->augend = $augend;
        $this->addend = $addend;
    }

    public function reduce(string $to): Money
    {
        $amount = $this->augend->amount + $this->addend->amount;

        return Money::createFromCurrency($amount, $to);
    }
}
