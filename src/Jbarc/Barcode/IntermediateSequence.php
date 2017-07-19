<?php

declare(strict_types=1);

namespace Jbarc\Barcode;

use Jbarc\Exception\InvalidArgumentException;

/**
 * Class Intermediate
 * Jens Schulze, github.com/jensschulze
 */
class IntermediateSequence implements \Iterator
{
    /**
     * @var IntermediateSequenceElement[]
     */
    private $sequence = [];

    /**
     * @var int
     */
    private $position = 0;


    public function addValue(string $value, float $height = 1.0): IntermediateSequence
    {
        $this->sequence[] = new IntermediateSequenceElement($value, $height);

        return $this;
    }


    public function addValues(string $values, float $height = 1.0): void
    {
        $splittedValues = str_split($values);
        foreach ($splittedValues as $value) {
            $this->addValue($value, $height);
        }
    }


    public function getLength(): int
    {
        return count($this->sequence);
    }


    public function getElement(int $position): IntermediateSequenceElement
    {
        if (!isset($this->sequence[$position])) {
            throw new InvalidArgumentException("Element with index '$position' does not exist'");
        }

        return $this->sequence[$position];
    }


    public function current(): IntermediateSequenceElement
    {
        return $this->sequence[$this->position];
    }


    public function key(): int
    {
        return $this->position;
    }


    public function next(): void
    {
        ++$this->position;
    }


    public function rewind(): void
    {
        $this->position = 0;
    }


    public function valid(): bool
    {
        return isset($this->sequence[$this->position]);
    }
}