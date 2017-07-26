<?php

declare(strict_types=1);

namespace Jbarc\Barcode\Entity;

use Jbarc\Exception\InvalidArgumentException;

/**
 * Class Layout
 * Jens Schulze, github.com/jensschulze
 */
class Layout
{
    /**
     * @var int
     */
    private $totalHeight;

    /**
     * @var TextStyle
     */
    private $textStyle;

    /**
     * @var int|null
     */
    private $maxBarHeight;

    /**
     * @var int|null
     */
    private $minBarHeight;

    /**
     * @var int
     */
    private $barcodeWidth = 0;

    /**
     * @var int
     */
    private $totalWidth = 0;

    /**
     * @var array
     */
    private static $allowedTextAnchors = [
        'LT',
        'MT',
        'RT',
        'LM',
        'MM',
        'RM',
        'LB',
        'MB',
        'RB',
    ];

    /**
     * @var string
     */
    private $textAnchor = 'LT';

    /**
     * @var int
     */
    private $textX = 0;

    /**
     * @var int
     */
    private $textY = 0;


    public function __construct(int $totalHeight, TextStyle $textStyle)
    {
        $this->totalHeight = $totalHeight;
        $this->textStyle   = $textStyle;
    }


    public function getTotalHeight(): int
    {
        return $this->totalHeight;
    }


    public function getTextStyle(): TextStyle
    {
        return $this->textStyle;
    }


    public function getMaxBarHeight(): ?int
    {
        return $this->maxBarHeight;
    }


    public function setMaxBarHeight(int $maxBarHeight): Layout
    {
        $this->maxBarHeight = $maxBarHeight;

        return $this;
    }


    public function getMinBarHeight(): ?int
    {
        return $this->minBarHeight;
    }


    public function setMinBarHeight(int $minBarHeight): Layout
    {
        $this->minBarHeight = $minBarHeight;

        return $this;
    }


    public function notifyBarHeight($barHeight): Layout
    {
        if (null === $this->minBarHeight || $barHeight < $this->minBarHeight) {
            $this->minBarHeight = $barHeight;
        }

        if (null === $this->maxBarHeight || $barHeight > $this->maxBarHeight) {
            $this->maxBarHeight = $barHeight;
        }

        return $this;
    }


    public function getBarcodeWidth(): int
    {
        return $this->barcodeWidth;
    }


    public function setBarcodeWidth(int $barcodeWidth): Layout
    {
        $this->barcodeWidth = $barcodeWidth;

        return $this;
    }


    public function getTotalWidth(): int
    {
        return $this->totalWidth;
    }


    public function setTotalWidth(int $totalWidth): Layout
    {
        $this->totalWidth = $totalWidth;

        return $this;
    }


    /**
     * @return string
     */
    public function getTextAnchor(): string
    {
        return $this->textAnchor;
    }


    /**
     * @param string $textAnchor
     *
     * @return Layout
     * @throws InvalidArgumentException
     */
    public function setTextAnchor(string $textAnchor): Layout
    {
        if (!in_array($textAnchor, self::$allowedTextAnchors, true)) {
            throw new InvalidArgumentException("Invalid anchor '{$textAnchor}'");
        }
        $this->textAnchor = $textAnchor;

        return $this;
    }


    public function getTextX(): int
    {
        return $this->textX;
    }


    public function setTextX(int $textX): Layout
    {
        $this->textX = $textX;

        return $this;
    }


    public function getTextY(): int
    {
        return $this->textY;
    }


    public function setTextY(int $textY): Layout
    {
        $this->textY = $textY;

        return $this;
    }
}