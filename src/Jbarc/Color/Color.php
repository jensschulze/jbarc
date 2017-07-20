<?php

declare(strict_types=1);

namespace Jbarc\Color;

interface Color
{
    public function getRed();


    public function getGreen();


    public function getBlue();


    public function __toString();
}