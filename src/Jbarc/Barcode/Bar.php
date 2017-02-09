<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 26.11.16
 * Time: 17:58
 */

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
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var int
     */
    private $topPosition;


    /**
     * @param bool $type
     * @param int  $width
     * @param int  $height
     * @param int  $topPosition
     */
    public function __construct($type, $width, $height, $topPosition)
    {
        if (!is_bool($type)) {
            throw new InvalidArgumentException('$type must be bool');
        }

        if (!is_int($width)) {
            throw new InvalidArgumentException('$width must be integer');
        }
        if ($width < 0) {
            throw new OutOfBoundsException('$width must be greater than 0');
        }

        if (!is_int($height)) {
            throw new InvalidArgumentException('$height must be integer');
        }
        if ($height < 0) {
            throw new OutOfBoundsException('$height must be greater than 0');
        }

        if (0 !== $topPosition && 1 !== $topPosition) {
            throw new InvalidArgumentException('$topPosition must be 0 or 1');
        }

        $this->type        = $type;
        $this->width       = $width;
        $this->height      = $height;
        $this->topPosition = $topPosition;
    }


    /**
     * @return bool
     */
    public function isBar()
    {
        return (Bar::BAR === $this->type);
    }


    /**
     * @return bool
     */
    public function isSpace()
    {
        return (Bar::SPACE === $this->type);
    }


    /**
     * @return bool
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }


    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }


    /**
     * @return int
     */
    public function getTopPosition()
    {
        return $this->topPosition;
    }
}
