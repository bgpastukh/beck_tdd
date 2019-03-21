<?php declare(strict_types=1);


namespace App;


/**
 * Class Bank
 * @package App
 */
class Bank
{
    public function reduce(Expression $source, string $to): Money
    {
        return $source->reduce($to);
    }
}
