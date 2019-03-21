<?php


namespace App;


/**
 * Interface Expression
 * @package App
 */
interface Expression
{
    /**
     * @param Bank $bank
     * @param string $to
     * @return Money
     */
    public function reduce(Bank $bank, string $to): Money;

    /**
     * @param Expression $addend
     * @return Expression
     */
    public function plus(Expression $addend): Expression;

    /**
     * @param int $multiplier
     * @return Expression
     */
    public function times(int $multiplier): Expression;
}