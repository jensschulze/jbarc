<?php

declare(strict_types=1);

namespace Jbarc\Barcode\ImageDriver;

use Jbarc\Color\Color;

interface Driver
{
    public function initPicture(int $width, int $height, Color $color);


    public function addRectangle(int $x1, int $y1, int $width, int $height);


    public function addText(string $text, int $x, int $y);


    public function getPicture();
}