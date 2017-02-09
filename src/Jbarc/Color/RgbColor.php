<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 26.11.16
 * Time: 20:45
 */

namespace Jbarc\Color;


use Jbarc\Exception\InvalidArgumentException;
use Jbarc\Exception\OutOfBoundsException;

class RgbColor implements Color
{
    /**
     * @var int
     */
    private $r;

    /**
     * @var int
     */
    private $g;

    /**
     * @var int
     */
    private $b;


    public function getRed()
    {
        return $this->r;
    }


    public function getGreen()
    {
        return $this->g;
    }


    public function getBlue()
    {
        return $this->b;
    }


    public function __construct($r, $g, $b)
    {
        if (!is_numeric($r) || !is_numeric($g) || !is_numeric($b)) {
            throw new InvalidArgumentException('Color values must be numeric');
        }
        if ($r < 0 || $r > 255) {
            throw new OutOfBoundsException('$r must be between 0 and 255');
        }
        if ($g < 0 || $g > 255) {
            throw new OutOfBoundsException('$g must be between 0 and 255');
        }
        if ($b < 0 || $b > 255) {
            throw new OutOfBoundsException('$b must be between 0 and 255');
        }

        $this->r = $r;
        $this->g = $g;
        $this->b = $b;
    }
}