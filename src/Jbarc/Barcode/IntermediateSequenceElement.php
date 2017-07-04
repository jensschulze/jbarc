<?php

declare(strict_types=1);

namespace Jbarc\Barcode;

/**
 * Class IntermediateSequenceElement
 * Jens Schulze, github.com/jensschulze
 */
class IntermediateSequenceElement
{
    /**
     * @var int
     */
    private $value;

    /**
     * @var float
     */
    private $height;


    public function __construct(int $value, float $height)
    {
        $this->value  = $value;
        $this->height = $height;
    }


    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }


    /**
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }
}