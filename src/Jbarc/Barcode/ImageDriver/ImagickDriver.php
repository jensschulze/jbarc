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


    /**
     * {@inheritdoc}
     */
    public function initPicture($width, $height, Color $color)
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


    /**
     * {@inheritdoc}
     */
    public function addRectangle($x1, $y1, $x2, $y2)
    {
        $this->bar->rectangle($x1, $y1, $x2, $y2);
    }


    /**
     * {@inheritdoc}
     */
    public function getPicture()
    {
        $this->image->drawImage($this->bar);

        return $this->image;
    }
}