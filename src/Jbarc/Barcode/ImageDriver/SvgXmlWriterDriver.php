<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 26.02.17
 * Time: 20:55
 */

namespace Jbarc\Barcode\ImageDriver;


use Jbarc\Color\Color;
use XMLWriter;

class SvgXmlWriterDriver implements Driver
{
    /**
     * @var XMLWriter
     */
    private $xmlWriter;

    /**
     * @var bool
     */
    private $isFinalized = false;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var Color
     */
    private $color;


    public function __construct(XMLWriter $xmlWriter)
    {
        $this->xmlWriter = $xmlWriter;
    }


    /**
     * @param int   $width
     * @param int   $height
     * @param Color $color
     */
    public function initPicture($width, $height, Color $color)
    {
        $this->width  = $width;
        $this->height = $height;
        $this->color  = $color;

        $this->xmlWriter->openMemory();
        $this->xmlWriter->startDocument('1.0', 'UTF-8', 'no');
        $this->xmlWriter->startDTD('svg', '-//W3C//DTD SVG 1.1//EN','http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd');
        $this->xmlWriter->endDTD();
        $this->xmlWriter->startElement('svg');
        $this->xmlWriter->startAttribute('width');
        $this->xmlWriter->text($this->width);
        $this->xmlWriter->endAttribute();
        $this->xmlWriter->startAttribute('height');
        $this->xmlWriter->text($this->height);
        $this->xmlWriter->endAttribute();
        $this->xmlWriter->startAttribute('version');
        $this->xmlWriter->text('1.1');
        $this->xmlWriter->endAttribute();
        $this->xmlWriter->startAttribute('xmlns');
        $this->xmlWriter->text('http://www.w3.org/2000/svg');
        $this->xmlWriter->endAttribute();
        $this->xmlWriter->startElement('g');
        $this->xmlWriter->startAttribute('id');
        $this->xmlWriter->text('bars');
        $this->xmlWriter->endAttribute();
        $this->xmlWriter->startAttribute('stroke');
        $this->xmlWriter->text('none');
        $this->xmlWriter->endAttribute();
    }


    /**
     * @param int $x1
     * @param int $y1
     * @param int $width
     * @param int $height
     */
    public function addRectangle($x1, $y1, $width, $height)
    {
        $this->xmlWriter->startElement('rect');
        $this->xmlWriter->startAttribute('x');
        $this->xmlWriter->text($x1);
        $this->xmlWriter->endAttribute();
        $this->xmlWriter->startAttribute('y');
        $this->xmlWriter->text($y1);
        $this->xmlWriter->endAttribute();
        $this->xmlWriter->startAttribute('width');
        $this->xmlWriter->text($width);
        $this->xmlWriter->endAttribute();
        $this->xmlWriter->startAttribute('height');
        $this->xmlWriter->text($height);
        $this->xmlWriter->endAttribute();
        $this->xmlWriter->startAttribute('fill');
        $this->xmlWriter->text($this->color);
        $this->xmlWriter->endAttribute();
        $this->xmlWriter->endElement();
    }


    /**
     * @return mixed
     */
    public function getPicture()
    {
        $this->finalize();

        return $this->xmlWriter->outputMemory();
    }


    private function finalize()
    {
        if (!$this->isFinalized) {
            $this->isFinalized = true;
            $this->xmlWriter->endElement(); // g
            $this->xmlWriter->endElement(); // svg
            $this->xmlWriter->endDocument();
        }
    }
}