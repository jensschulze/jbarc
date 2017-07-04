<?php

namespace Jbarc\Barcode\Process;

class UppercaseProcess implements Process
{
    public function getProcessedData(string $data): string
    {
        return strtoupper($data);
    }
}
