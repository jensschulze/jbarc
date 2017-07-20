<?php

declare(strict_types=1);

namespace Jbarc\Barcode\Process;

class NoopProcess implements Process
{
    public function getProcessedData(string $data): string
    {
        return $data;
    }
}