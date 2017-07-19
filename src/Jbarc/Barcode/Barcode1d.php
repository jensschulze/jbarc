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
    public function getData(): string
    {
        return $this->data;
    }


    /**
     * @var string $data
     *
     * @return Barcode1d
     * @throws InvalidArgumentException
     */
    public function setData($data): Barcode1d
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
    public function getRawData(): string
    {
        return $this->rawData;
    }


    /**
     * @var string $rawData
     *
     * @return Barcode1d
     * @throws InvalidArgumentException
     */
    public function setRawData($rawData): Barcode1d
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
    public function getBars(): array
    {
        return $this->bars;
    }


    /**
     * @param Bar $bar
     *
     * @return Barcode1d
     */
    public function addBar(Bar $bar): Barcode1d
    {
        $this->maxWidth += $bar->getWidth();
        $this->notifyHeight($bar->getHeight());
        $this->bars[] = $bar;

        return $this;
    }


    /**
     * @return float
     */
    public function getMaxWidth(): float
    {
        return $this->maxWidth;
    }


    /**
     * @param float $maxWidth
     *
     * @return Barcode1d
     * @throws InvalidArgumentException
     */
    public function setMaxWidth($maxWidth): Barcode1d
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
     * @throws InvalidArgumentException
     */
    public function increaseMaxWidth($increment): Barcode1d
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
    public function getMaxHeight(): float
    {
        return $this->maxHeight;
    }


    public function notifyHeight($height): Barcode1d
    {
        if ($height > $this->maxHeight) {
            $this->maxHeight = $height;
        }

        return $this;
    }


    /**
     * @param int $maxHeight
     *
     * @return Barcode1d
     * @throws InvalidArgumentException
     */
    public function setMaxHeight($maxHeight): Barcode1d
    {
        if (!is_numeric($maxHeight)) {
            throw new InvalidArgumentException('$maxHeight must be integer');
        }
        $this->maxHeight = $maxHeight;

        return $this;
    }
}
