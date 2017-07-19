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
     * @var string
     */
    private $value;

    /**
     * @var float
     */
    private $height;


    public function __construct(string $value, float $height)
    {
        $this->value  = $value;
        $this->height = $height;
    }


    /**
     * @return string
     */
    public function getValue(): string
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