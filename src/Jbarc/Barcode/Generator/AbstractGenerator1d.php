<?php

declare(strict_types=1);

namespace Jbarc\Barcode\Generator;

use Jbarc\Barcode\Entity\Barcode1d;
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


    abstract public function generate(string $data, Barcode1d $barcode): Barcode1d;
}