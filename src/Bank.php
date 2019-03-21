<?php declare(strict_types=1);


namespace App;

use Ds\Map;


/**
 * Class Bank
 * @package App
 */
class Bank
{
    /** @var Map */
    private $rates;

    public function __construct()
    {
        $this->rates = new Map();
    }

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
     * @param string $from
     * @param string $to
     * @param int $rate
     */
    public function addRate(string $from, string $to, int $rate): void
    {
        $this->rates->put(new Pair($from, $to), $rate);
    }

    /**
     * @param string $from
     * @param string $to
     * @return int
     */
    public function rate(string $from, string $to): int
    {
        if ($from === $to) {
            return 1;
        }

        return $this->rates->get(new Pair($from, $to));
    }
}
