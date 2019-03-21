<?php declare(strict_types=1);


namespace App;

use Ds\Hashable;


/**
 * Class Pair
 * @package App
 */
class Pair implements Hashable
{
    /** @var string */
    private $from;


    /** @var string */
    private $to;

    /**
     * Pair constructor.
     * @param string $from
     * @param string $to
     */
    public function __construct(string $from, string $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @param Pair $object
     * @return bool
     */
    public function equals($object): bool
    {
        return $this->from === $object->from && $this->to === $object->to;
    }

    /**
     * @return int
     */
    public function hash(): int
    {
        return 0;
    }
}
