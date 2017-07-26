<?php

declare(strict_types=1);

namespace Jbarc\Barcode\Entity;

/**
 * Class TextElement
 * Jens Schulze, github.com/jensschulze
 */
class TextElement
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;


    public function __construct(string $text, int $x, int $y)
    {
        $this->text = $text;
        $this->x    = $x;
        $this->y    = $y;
    }


    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }


    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }


    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }
}