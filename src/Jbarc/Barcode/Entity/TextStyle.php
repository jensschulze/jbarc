<?php

declare(strict_types=1);

namespace Jbarc\Barcode\Entity;

use Jbarc\Exception\FileNotFoundException;

/**
 * Class TextStyle
 * Jens Schulze, github.com/jensschulze
 */
class TextStyle
{
    /**
     * @var string
     */
    private $fontPath;

    /**
     * @var float
     */
    private $fontSize;


    /**
     * @param string $fontPath
     * @param float  $fontSize
     *
     * @throws FileNotFoundException
     */
    public function __construct(string $fontPath, float $fontSize)
    {
        if (!is_file($fontPath)) {
            throw new FileNotFoundException("Font path '{$fontPath}' not found");
        }
        $this->fontPath = $fontPath;

        $this->fontSize = $fontSize;
    }


    /**
     * @return string
     */
    public function getFontPath(): string
    {
        return $this->fontPath;
    }


    /**
     * @return float
     */
    public function getFontSize(): float
    {
        return $this->fontSize;
    }
}