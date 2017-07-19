<?php

namespace Jbarc\Barcode;

interface Barcode
{
    /**
     * @return Bar[]
     */
    public function getBars(): array;


    /**
     * @return float
     */
    public function getMaxHeight(): float;


    /**
     * @return float
     */
    public function getMaxWidth(): float;


    /**
     * @return string
     */
    public function getData(): string;
}