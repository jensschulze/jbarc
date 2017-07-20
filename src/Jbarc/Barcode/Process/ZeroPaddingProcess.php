<?php

declare(strict_types=1);

namespace Jbarc\Barcode\Process;

use Jbarc\Exception\InvalidArgumentException;

class ZeroPaddingProcess implements Process
{
    private $padLength;


    /**
     * @param $padLength
     *
     * @return ZeroPaddingProcess
     * @throws InvalidArgumentException
     */
    public function setPadLength($padLength): ZeroPaddingProcess
    {
        if (!is_int($padLength)) {
            throw new InvalidArgumentException('$padLength must be integer');
        }

        $this->padLength = $padLength;

        return $this;
    }


    /**
     * @param string $data
     *
     * @return string
     */
    public function getProcessedData(string $data): string
    {
        if (null !== $this->padLength) {
            $data = str_pad($data, $this->padLength, '0', STR_PAD_LEFT);
        }

        return $data;
    }
}