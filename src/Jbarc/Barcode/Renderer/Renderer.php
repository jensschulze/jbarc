<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 25.11.16
 * Time: 21:11
 */

namespace Jbarc\Barcode\Renderer;


use Jbarc\Barcode\Barcode;
use Jbarc\Color\Color;

interface Renderer
{
    public function render(Barcode $barcode, $width, $height, Color $color);
}