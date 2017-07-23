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
     * @param int     $smallestBarWidth
     * @param float   $height
     * @param Color   $color
     *
     * @return mixed
     */
    public function render(Barcode $barcode, int $smallestBarWidth, float $height, Color $color)
    {
        // calculate image size
        $totalWidth = ($barcode->getMaxWidth() * $smallestBarWidth);
        $this->driver->initPicture((int) $totalWidth, (int) $height, $color);

        // print bars
        $x = 0;
        foreach ($barcode->getBars() as $k => $bar) {
            $barWidth = (int) round($bar->getWidth() * $smallestBarWidth, 3);

            if ($bar->isBar()) {
                $barHeight = (int) round($bar->getHeight() * $height / $barcode->getMaxHeight(), 3);
                $y         = (int) round($bar->getTopPosition() * $height / $barcode->getMaxHeight(), 3);

                // draw a vertical bar
                $this->driver->addRectangle($x, $y, $barWidth, $barHeight);
            }

            $x += $barWidth;
        }

        foreach ($barcode->getText() as $textElement) {
            $this->driver->addText($textElement->getText(), $textElement->getX(), $textElement->getY());
        }

        return $this->driver->getPicture();
    }
}