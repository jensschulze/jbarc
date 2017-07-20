<?php

declare(strict_types=1);

namespace Jbarc\Barcode\Renderer;

use Jbarc\Barcode\Barcode;
use Jbarc\Color\Color;

interface Renderer
{
    public function render(Barcode $barcode, float $relativeWidth, float $height, Color $color);
}