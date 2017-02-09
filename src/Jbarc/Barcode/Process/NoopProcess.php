<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 27.11.16
 * Time: 21:46
 */

namespace Jbarc\Barcode\Process;


class NoopProcess implements Process
{
    /**
     * {@inheritdoc}
     */
    public function getProcessedData($data)
    {
        return $data;
    }
}