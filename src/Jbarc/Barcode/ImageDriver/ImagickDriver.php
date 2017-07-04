<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 26.11.16
 * Time: 21:05
 */

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


    public function initPicture(float $width, float $height, Color $color): void
    {
        $this->backgroundColor = new \ImagickPixel('rgb(255,255,255');
        $foregroundColor       = new \ImagickPixel(
            'rgb('.$color->getRed().','.$color->getGreen().','.$color->getBlue(
            ).')'
        );
        $this->image           = new \Imagick();
        $this->image->newImage($width, $height, 'none', 'png');
        $this->bar = new \ImagickDraw();
        $this->bar->setFillColor($foregroundColor);
    }


    public function addRectangle(float $x1, float $y1, float $width, float $height): void
    {
        $this->bar->rectangle($x1, $y1, $width - 1, $height - 1);
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