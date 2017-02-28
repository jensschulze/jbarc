<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 28.02.17
 * Time: 21:43
 */

namespace Jbarc\Color;


abstract class AbstractColor implements Color
{

    public abstract function getRed();


    public abstract function getGreen();


    public abstract function getBlue();


    public abstract function __toString();


    protected function formatHex($decimalValue)
    {
        $hexValue    = dechex($decimalValue);
        $paddedValue = substr('00' . $hexValue, -2);

        return $paddedValue;
    }
}