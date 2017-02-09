<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 29.11.16
 * Time: 23:44
 */

namespace Jbarc\Barcode\Process;


use Jbarc\Exception\InvalidArgumentException;

class ZeroPaddingProcess implements Process
{
    private $padLength = null;


    /**
     * @param $padLength
     *
     * @return $this
     */
    public function setPadLength($padLength)
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
    public function getProcessedData($data)
    {
        if (null !== $this->padLength) {
            $data = str_pad(
                (string) $data,
                $this->padLength,
                '0',
                STR_PAD_LEFT
            );
        }

        return $data;
    }
}