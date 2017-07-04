<?php

namespace Jbarc\Barcode\Process;

interface Process
{
    public function getProcessedData(string $data): string;
}