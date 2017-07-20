<?php

declare(strict_types=1);

namespace Jbarc\Barcode\Process;

interface Process
{
    public function getProcessedData(string $data): string;
}