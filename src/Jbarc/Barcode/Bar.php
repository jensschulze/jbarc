<?php

namespace Jbarc\Barcode;

use Jbarc\Exception\InvalidArgumentException;
use Jbarc\Exception\OutOfBoundsException;

class Bar
{
    const BAR = true;

    const SPACE = false;

    /**
     * @var bool
     */
    private $type;

    /**
     * @var float
     */
    private $width;

    /**
     * @var float
     */
    private $height;

    /**
     * @var float
     */
    private $topPosition;


    /**
     * @param bool  $type
     * @param float $width
     * @param float $height
     * @param float $topPosition
     *
     * @throws InvalidArgumentException
     * @throws OutOfBoundsException
     */
    public function __construct(bool $type, float $width, float $height, float $topPosition)
    {
        if ($width < 0) {
            throw new OutOfBoundsException('$width must be greater than 0');
        }

        if ($height < 0) {
            throw new OutOfBoundsException('$height must be greater than 0');
        }

        if (0.0 !== $topPosition && 1.0 !== $topPosition) {
            throw new InvalidArgumentException('$topPosition must be 0 or 1');
        }

        $this->type        = $type;
        $this->width       = $width;
        $this->height      = $height;
        $this->topPosition = $topPosition;
    }


    public function isBar(): bool
    {
        return (Bar::BAR === $this->type);
    }


    public function isSpace(): bool
    {
        return (Bar::SPACE === $this->type);
    }


    public function getType(): bool
    {
        return $this->type;
    }


    public function getWidth(): float
    {
        return $this->width;
    }


    public function getHeight(): float
    {
        return $this->height;
    }


    public function getTopPosition(): float
    {
        return $this->topPosition;
    }
}
