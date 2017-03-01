<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 26.11.16
 * Time: 18:15
 */

namespace Jbarc\Barcode\ImageDriver;


use Jbarc\Color\Color;

interface Driver
{
    /**
     * @param int   $width
     * @param int   $height
     * @param Color $color
     */
    public function initPicture($width, $height, Color $color);


    /**
     * @param int $x1
     * @param int $y1
     * @param int $width
     * @param int $height
     */
    public function addRectangle($x1, $y1, $width, $height);


    /**
     * @return mixed
     */
    public function getPicture();
}