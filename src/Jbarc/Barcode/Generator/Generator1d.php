<?php

declare(strict_types=1);

namespace Jbarc\Barcode\Generator;

use Jbarc\Barcode\Entity\Barcode1d;

interface Generator1d extends Generator
{
    public function generate(string $data, Barcode1d $barcode): Barcode1d;
}