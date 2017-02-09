<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 29.11.16
 * Time: 22:08
 */

namespace Jbarc\Barcode;


interface Barcode
{
    /**
     * @return Bar[]
     */
    public function getBars();


    /**
     * @return int
     */
    public function getMaxHeight();


    /**
     * @return int
     */
    public function getMaxWidth();
}