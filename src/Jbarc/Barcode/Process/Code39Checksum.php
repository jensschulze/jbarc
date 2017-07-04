<?php

namespace Jbarc\Barcode\Process;

use Jbarc\Exception\OutOfBoundsException;

class Code39Checksum implements Process
{
    /**
     * @throws OutOfBoundsException
     */
    public function getProcessedData(string $data): string
    {
        $chars = [
            '0',
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',
            'H',
            'I',
            'J',
            'K',
            'L',
            'M',
            'N',
            'O',
            'P',
            'Q',
            'R',
            'S',
            'T',
            'U',
            'V',
            'W',
            'X',
            'Y',
            'Z',
            '-',
            '.',
            ' ',
            '$',
            '/',
            '+',
            '%',
        ];
        $sum   = 0;
        $clen  = strlen($data);
        for ($i = 0; $i < $clen; ++$i) {
            $k = array_keys($chars, $data{$i});
            if (empty($k)) {
                throw new OutOfBoundsException("Illegal Character '$data{$i}'");
            }
            $sum += $k[0];
        }
        $j = ($sum % 43);

        return $data . $chars[$j];
    }
}
