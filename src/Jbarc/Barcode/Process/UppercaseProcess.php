<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 27.11.16
 * Time: 22:02
 */

namespace Jbarc\Barcode\Process;


class UppercaseProcess implements Process
{

    /**
     * {@inheritdoc}
     */
    public function getProcessedData($data)
    {
        return strtoupper($data);
    }
}
