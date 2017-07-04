<?php

namespace Jbarc\Barcode\ImageDriver;

use Jbarc\Color\Color;

interface Driver
{
    public function initPicture(float $width, float $height, Color $color);


    public function addRectangle(float $x1, float $y1, float $width, float $height);


    public function getPicture();
}