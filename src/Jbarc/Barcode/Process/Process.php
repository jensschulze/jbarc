<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 27.11.16
 * Time: 21:42
 */

namespace Jbarc\Barcode\Process;


interface Process
{
    /**
     * @param string $data
     *
     * @return string
     */
    public function getProcessedData($data);
}