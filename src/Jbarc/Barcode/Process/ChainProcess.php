<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 30.11.16
 * Time: 00:47
 */

namespace Jbarc\Barcode\Process;


use Jbarc\Exception\InvalidArgumentException;

class ChainProcess implements Process
{
    /**
     * @var Process[]
     */
    private $processes = [];


    public function __construct(array $processes = [])
    {
        foreach ($processes as $process) {
            if (!($process instanceof Process)) {
                throw new InvalidArgumentException('Only instances of Process allowed');
            }
        }
        $this->processes = $processes;
    }


    /**
     * @param Process $process
     *
     * @return $this
     */
    public function addProcess(Process $process)
    {
        $this->processes[] = $process;

        return $this;
    }


    public function getProcessedData($data)
    {
        foreach ($this->processes as $process) {
            $data = $process->getProcessedData($data);
        }

        return $data;
    }
}