<?php

declare(strict_types=1);

namespace Jbarc\Barcode\ImageDriver;

use Jbarc\Color\Color;

class ImagickDriver implements Driver
{
    /**
     * @var \Imagick
     */
    private $image;

    /**
     * @var \ImagickPixel
     */
    private $backgroundColor;

    /**
     * @var \ImagickDraw
     */
    private $bar;


    public function initPicture(int $width, int $height, Color $color): void
    {
        $this->backgroundColor = new \ImagickPixel('rgb(255,255,255');
        $foregroundColor       = new \ImagickPixel('rgb(' . $color->getRed() . ',' . $color->getGreen() . ',' . $color->getBlue() . ')');
        $this->image           = new \Imagick();
        $this->image->newImage($width, $height, 'none', 'png');
        $this->bar = new \ImagickDraw();
        $this->bar->setFillColor($foregroundColor);
    }


    public function addRectangle(int $x1, int $y1, int $width, int $height): void
    {
        $this->bar->rectangle($x1, $y1, $x1 + $width - 1, $y1 + $height - 1);
    }


    /**
     * {@inheritdoc}
     */
    public function getPicture(): \Imagick
    {
        $this->image->drawImage($this->bar);

        return $this->image;
    }
}