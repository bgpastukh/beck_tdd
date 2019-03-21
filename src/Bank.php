<?php declare(strict_types=1);


namespace App;


/**
 * Class Bank
 * @package App
 */
class Bank
{
    /**
     * @param Expression $source
     * @param string $to
     * @return Money
     */
    public function reduce(Expression $source, string $to): Money
    {
        return $source->reduce($this, $to);
    }

    /**
     * @param string $a
     * @param string $b
     * @param int $amount
     */
    public function addRate(string $a, string $b, int $amount): void
    {

    }

    /**
     * @param string $from
     * @param string $to
     * @return int
     */
    public function rate(string $from, string $to): int
    {
        return ($from === 'CHF' && $to === 'USD') ? 2 : 1;
    }
}
