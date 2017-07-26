<?php

declare(strict_types=1);

namespace Jbarc\Barcode\ImageDriver;

use Jbarc\Color\Color;

class GdDriver implements Driver
{
    /**
     * @var
     */
    private $image;

    /**
     * @var
     */
    private $foregroundColor;


    public function initPicture(int $width, int $height, Color $color): void
    {
        $this->image = imagecreate($width, $height);
        $bgcol       = imagecolorallocate($this->image, 255, 255, 255);
        imagecolortransparent($this->image, $bgcol);
        $this->foregroundColor = imagecolorallocate($this->image, $color->getRed(), $color->getGreen(), $color->getBlue());
    }


    public function addRectangle(int $x1, int $y1, int $width, int $height): void
    {
        imagefilledrectangle($this->image, $x1, $y1, $x1 + $width - 1, $y1 + $height - 1, $this->foregroundColor);
    }


    public function getPicture()
    {
        ob_start();
        imagepng($this->image);
        $imagedata = ob_get_clean();
        imagedestroy($this->image);

        return $imagedata;
    }


    public function addText(string $text, int $x, int $y): void
    {
        // TODO: Implement addText() method.
    }
}