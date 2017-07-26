<?php

declare(strict_types=1);

namespace Jbarc\ImageDriver;

use Jbarc\Color\Color;
use Jbarc\Exception\FileNotFoundException;

class ImagickDriver implements Driver
{
    private $positions = [
        'LT' => \Imagick::GRAVITY_NORTHWEST,
        'MT' => \Imagick::GRAVITY_NORTH,
        'RT' => \Imagick::GRAVITY_NORTHEAST,
        'LM' => \Imagick::GRAVITY_WEST,
        'MM' => \Imagick::GRAVITY_CENTER,
        'RM' => \Imagick::GRAVITY_EAST,
        'LB' => \Imagick::GRAVITY_SOUTHWEST,
        'MB' => \Imagick::GRAVITY_SOUTH,
        'RB' => \Imagick::GRAVITY_SOUTHEAST,
    ];

    /**
     * @var \Imagick
     */
    private $image;

    /**
     * @var \ImagickPixel
     */
    private $backgroundColor;

    /**
     * @var \ImagickDraw
     */
    private $bars;

    /**
     * @var \ImagickDraw
     */
    private $textDrawSettings;

    private $textSettings = [
        'font'     => '',
        'kerning'  => .25,
        'opacity'  => 1,
        'position' => 'LB',
        'size'     => 16,
    ];


    public function __construct(array $textSetting = [])
    {
        $this->textSettings['font'] = __DIR__ . '/../../../assets/OCRB.otf';
        foreach ($this->textSettings as $key => $value) {
            if (array_key_exists($key, $textSetting)) {
                $this->textSettings[$key] = $textSetting;
            }
        }
    }


    public function initPicture(int $width, int $height, Color $color): void
    {
        $this->backgroundColor = new \ImagickPixel('rgb(255,255,255');
        $foregroundColor       = new \ImagickPixel('rgb(' . $color->getRed() . ',' . $color->getGreen() . ',' . $color->getBlue() . ')');
        $this->image           = new \Imagick();
        $this->image->newImage($width, $height, 'none', 'png');
        $this->bars = new \ImagickDraw();
        $this->bars->setFillColor($foregroundColor);
        $this->textDrawSettings = new \ImagickDraw();
        $this->textDrawSettings->setFillColor($foregroundColor);
        $this->textDrawSettings->setStrokeWidth(0);
        $this->textDrawSettings->setStrokeOpacity(0);
        $this->textDrawSettings->setFillOpacity($this->textSettings['opacity']);
        $this->textDrawSettings->setStrokeAntialias(true);
        $this->textDrawSettings->setTextAntialias(true);
        $this->textDrawSettings->setTextKerning($this->textSettings['kerning']);
        if (!$this->textDrawSettings->setFont($this->textSettings['font'])) {
            throw new FileNotFoundException("Font '{$this->textSettings['font']}' not found");
        }
        $this->textDrawSettings->setFontSize($this->textSettings['size']);
        $this->textDrawSettings->setGravity($this->positions[$this->textSettings['position']]);
    }


    public function addRectangle(int $x1, int $y1, int $width, int $height): void
    {
        $this->bars->rectangle($x1, $y1, $x1 + $width - 1, $y1 + $height - 1);
    }


    public function addText(string $text, int $x, int $y): void
    {
        $this->image->annotateImage($this->textDrawSettings, $x, $y, 0, $text);
    }


    /**
     * {@inheritdoc}
     */
    public function getPicture(): \Imagick
    {
        $this->image->drawImage($this->bars);

        return $this->image;
    }
}