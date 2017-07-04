<?php

namespace Jbarc\Barcode;

use Jbarc\Exception\InvalidArgumentException;

class Barcode1d implements Barcode
{
    /**
     * @var string
     */
    private $rawData;

    /**
     * @var string
     */
    private $data;

    /**
     * @var Bar[]
     */
    private $bars = [];

    /**
     * @var float
     */
    private $maxWidth = 0;

    /**
     * @var float
     */
    private $maxHeight = 1;


    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }


    /**
     * @var string $data
     *
     * @return $this
     */
    public function setData($data)
    {
        if (!is_string($data)) {
            throw new InvalidArgumentException('$data must be a string');
        }
        $this->data = $data;

        return $this;
    }


    /**
     * @return string
     */
    public function getRawData()
    {
        return $this->rawData;
    }


    /**
     * @var string $rawData
     *
     * @return $this
     */
    public function setRawData($rawData)
    {
        if (!is_string($rawData)) {
            throw new InvalidArgumentException('$rawData must be a string');
        }
        $this->rawData = $rawData;

        return $this;
    }


    /**
     * @return Bar[]
     */
    public function getBars()
    {
        return $this->bars;
    }


    /**
     * @param Bar $bar
     *
     * @return Barcode1d
     */
    public function addBar(Bar $bar)
    {
        $this->bars[] = $bar;
        if ($bar->getHeight() > $this->maxHeight) {
            $this->maxHeight = $bar->getHeight();
        }

        return $this;
    }


    /**
     * @return float
     */
    public function getMaxWidth()
    {
        return $this->maxWidth;
    }


    /**
     * @param float $maxWidth
     *
     * @return Barcode1d
     */
    public function setMaxWidth($maxWidth)
    {
        if (!is_numeric($maxWidth)) {
            throw new InvalidArgumentException('$maxWidth must be integer');
        }
        $this->maxWidth = $maxWidth;

        return $this;
    }


    /**
     * @param float $increment
     *
     * @return Barcode1d
     */
    public function increaseMaxWidth($increment)
    {
        if (!is_numeric($increment)) {
            throw new InvalidArgumentException('$increment must be integer');
        }
        $this->maxWidth += $increment;

        return $this;
    }


    /**
     * @return float
     */
    public function getMaxHeight()
    {
        return $this->maxHeight;
    }


    /**
     * @param int $maxHeight
     *
     * @return Barcode1d
     */
    public function setMaxHeight($maxHeight)
    {
        if (!is_numeric($maxHeight)) {
            throw new InvalidArgumentException('$maxHeight must be integer');
        }
        $this->maxHeight = $maxHeight;

        return $this;
    }
}
