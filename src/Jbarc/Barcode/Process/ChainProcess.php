<?php

namespace Jbarc\Barcode\Process;

use Jbarc\Exception\InvalidArgumentException;

class ChainProcess implements Process
{
    /**
     * @var Process[]
     */
    private $processes;


    public function __construct(array $processes = [])
    {
        foreach ($processes as $process) {
            if (!($process instanceof Process)) {
                throw new InvalidArgumentException('Only instances of Process allowed');
            }
        }
        $this->processes = $processes;
    }


    public function addProcess(Process $process): ChainProcess
    {
        $this->processes[] = $process;

        return $this;
    }


    public function getProcessedData(string $data): string
    {
        foreach ($this->processes as $process) {
            $data = $process->getProcessedData($data);
        }

        return $data;
    }
}