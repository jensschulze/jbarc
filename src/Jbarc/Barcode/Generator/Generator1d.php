<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 29.11.16
 * Time: 00:40
 */

namespace Jbarc\Barcode\Generator;


use Jbarc\Barcode\Barcode1d;

interface Generator1d extends Generator
{
    /**
     * @param string    $data
     * @param Barcode1d $barcode
     *
     * @return Barcode1d
     */
    public function generate($data, Barcode1d $barcode);
}