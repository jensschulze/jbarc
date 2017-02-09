<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 26.11.16
 * Time: 18:53
 */

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
     * @var int
     */
    private $maxWidth = 0;

    /**
     * @var int
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
     * @return $this
     */
    public function addBar(Bar $bar)
    {
        $this->bars[] = $bar;

        return $this;
    }


    /**
     * @return int
     */
    public function getMaxWidth()
    {
        return $this->maxWidth;
    }


    /**
     * @param int $maxWidth
     *
     * @return $this
     */
    public function setMaxWidth($maxWidth)
    {
        if (!is_int($maxWidth)) {
            throw new InvalidArgumentException('$maxWidth must be integer');
        }
        $this->maxWidth = $maxWidth;

        return $this;
    }


    /**
     * @param int $increment
     *
     * @return $this
     */
    public function increaseMaxWidth($increment)
    {
        if (!is_int($increment)) {
            throw new InvalidArgumentException('$increment must be integer');
        }
        $this->maxWidth += $increment;

        return $this;
    }


    /**
     * @return int
     */
    public function getMaxHeight()
    {
        return $this->maxHeight;
    }


    /**
     * @param int $maxHeight
     *
     * @return $this
     */
    public function setMaxHeight($maxHeight)
    {
        if (!is_int($maxHeight)) {
            throw new InvalidArgumentException('$maxHeight must be integer');
        }
        $this->maxHeight = $maxHeight;

        return $this;
    }
}