<?php

declare(strict_types=1);

namespace Jbarc\Barcode\Renderer;

use Jbarc\Barcode\Barcode;
use Jbarc\Barcode\ImageDriver\Driver;
use Jbarc\Color\Color;

class BarcodeRenderer implements Renderer
{
    /**
     * @var Driver
     */
    private $driver;


    public function __construct(Driver $driver)
    {
        $this->driver = $driver;
    }


    /**
     * @param Barcode $barcode
     * @param float   $relativeWidth
     * @param float   $height
     * @param Color   $color
     *
     * @return mixed
     */
    public function render(Barcode $barcode, float $relativeWidth, float $height, Color $color)
    {
        // calculate image size
        $totalWidth = ($barcode->getMaxWidth() * $relativeWidth);
        $this->driver->initPicture($totalWidth, $height, $color);

        // print bars
        $x = 0;
        foreach ($barcode->getBars() as $k => $bar) {
            $barWidth = round(($bar->getWidth() * $relativeWidth), 3);

            if ($bar->isBar()) {
                $barHeight = round(($bar->getHeight() * $height / $barcode->getMaxHeight()), 3);
                $y         = round(($bar->getTopPosition() * $height / $barcode->getMaxHeight()), 3);

                // draw a vertical bar
                $this->driver->addRectangle($x, $y, ($barWidth), ($barHeight));
            }

            $x += $barWidth;
        }

        return $this->driver->getPicture();
    }
}