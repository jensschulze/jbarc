<?php

namespace Jbarc\Barcode;

interface Barcode
{
    /**
     * @return Bar[]
     */
    public function getBars();


    /**
     * @return float
     */
    public function getMaxHeight();


    /**
     * @return float
     */
    public function getMaxWidth();


    /**
     * @return string
     */
    public function getData();
}