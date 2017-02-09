<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 29.11.16
 * Time: 23:26
 */

namespace Jbarc\Barcode\Generator;


use Jbarc\Barcode\Barcode1d;
use Jbarc\Barcode\Process\Process;

abstract class AbstractGenerator1d implements Generator1d
{
    /**
     * @var Process
     */
    protected $process;


    /**
     * @param Process $process
     */
    public function __construct(Process $process)
    {
        $this->process = $process;
    }


    public abstract function generate($data, Barcode1d $barcode);
}