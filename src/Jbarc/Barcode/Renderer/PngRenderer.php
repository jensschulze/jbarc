<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 26.11.16
 * Time: 18:58
 */

namespace Jbarc\Barcode\Renderer;


use Jbarc\Barcode\Barcode;
use Jbarc\Barcode\ImageDriver\Driver;
use Jbarc\Color\Color;

class PngRenderer implements Renderer
{
    /**
     * @var Driver
     */
    private $driver;


    public function __construct(Driver $driver)
    {
        $this->driver = $driver;
    }


    public function render(Barcode $barcode, $width, $height, Color $color)
    {
        // calculate image size
        $totalWidth = ($barcode->getMaxWidth() * $width);
        $this->driver->initPicture($totalWidth, $height, $color);

        // print bars
        $x = 0;
        foreach ($barcode->getBars() as $k => $bar) {
            $barWidth = round(($bar->getWidth() * $width), 3);

            if ($bar->isBar()) {
                $barHeight = round(($bar->getHeight() * $height / $barcode->getMaxHeight()), 3);
                $y         = round(($bar->getTopPosition() * $height / $barcode->getMaxHeight()), 3);

                // draw a vertical bar
                $this->driver->addRectangle($x, $y, ($x + $barWidth - 1), ($y + $barHeight - 1));
            }

            $x += $barWidth;
        }

        return $this->driver->getPicture();
    }
}