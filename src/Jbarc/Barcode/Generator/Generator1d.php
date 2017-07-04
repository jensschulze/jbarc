<?php

namespace Jbarc\Barcode\Generator;

use Jbarc\Barcode\Barcode1d;

interface Generator1d extends Generator
{
    public function generate(string $data, Barcode1d $barcode): Barcode1d;
}