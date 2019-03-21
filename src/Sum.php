<?php declare(strict_types=1);


namespace App;


/**
 * Class Sum
 * @package App
 */
class Sum implements Expression
{
    /**
     * @var Expression
     */
    public $augend;

    /**
     * @var Expression
     */
    public $addend;

    /**
     * Sum constructor.
     * @param Expression $augend
     * @param Expression $addend
     */
    public function __construct(Expression $augend, Expression $addend)
    {
        $this->augend = $augend;
        $this->addend = $addend;
    }

    /**
     * @param Bank $bank
     * @param string $to
     * @return Money
     */
    public function reduce(Bank $bank, string $to): Money
    {
        $amount = $this->augend->reduce($bank, $to)->amount + $this->addend->reduce($bank, $to)->amount;

        return Money::createFromCurrency($amount, $to);
    }

    /**
     * @param Expression $addend
     * @return Expression
     */
    public function plus(Expression $addend): Expression
    {
        return null;
    }
}
