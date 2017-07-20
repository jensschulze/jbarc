<?php

declare(strict_types=1);

namespace Jbarc\Color;

abstract class AbstractColor implements Color
{
    abstract public function getRed();


    abstract public function getGreen();


    abstract public function getBlue();


    abstract public function __toString();


    protected function formatHex($decimalValue)
    {
        $hexValue    = dechex($decimalValue);
        $paddedValue = substr('00' . $hexValue, -2);

        return $paddedValue;
    }
}