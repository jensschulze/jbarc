<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 26.11.16
 * Time: 20:51
 */

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


    /**
     * {@inheritdoc}
     */
    public function initPicture($width, $height, Color $color)
    {
        $this->image = imagecreate($width, $height);
        $bgcol       = imagecolorallocate($this->image, 255, 255, 255);
        imagecolortransparent($this->image, $bgcol);
        $this->foregroundColor = imagecolorallocate($this->image, $color->getRed(), $color->getGreen(), $color->getBlue());
    }


    /**
     * {@inheritdoc}
     */
    public function addRectangle($x1, $y1, $x2, $y2)
    {
        imagefilledrectangle($this->image, $x1, $y1, $x2, $y2, $this->foregroundColor);
    }


    /**
     * {@inheritdoc}
     */
    public function getPicture()
    {
        ob_start();
        imagepng($this->image);
        $imagedata = ob_get_clean();
        imagedestroy($this->image);

        return $imagedata;
    }
}