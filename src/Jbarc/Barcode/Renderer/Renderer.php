<?php

declare(strict_types=1);

namespace Jbarc\Barcode\Renderer;

use Jbarc\Barcode\Barcode;
use Jbarc\Color\Color;

interface Renderer
{
    public function render(Barcode $barcode, int $smallestBarWidth, float $height, Color $color);
}