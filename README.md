# Jbarc

Master: [![Build Status](https://travis-ci.org/jensschulze/jbarc.svg?branch=master)](https://travis-ci.org/jensschulze/jbarc)

Develop: [![Build Status](https://travis-ci.org/jensschulze/jbarc.svg?branch=develop)](https://travis-ci.org/jensschulze/jbarc)

* **category**    Library
* **package**     jensschulze/jbarc
* **author**      Nicola Asuni <info@tecnick.com>
* **author**      Jens Schulze
* **copyright**   2002-2016 Nicola Asuni - Tecnick.com LTD, 2017 Jens Schulze
* **license**     http://www.gnu.org/copyleft/lesser.html GNU-LGPL v3 (see LICENSE.TXT)
* **link**        https://github.com/jensschulze/jbarc
* **source**      https://github.com/jensschulze/jbarc
* **SRC DOC**     https://github.com/jensschulze/jbarc

This barcode library is basically the barcode part of the TCPDF library by Nicola Ansuni. The main objective is to refactor, and then further improve it.  

## Barcode formats
* EAN 13

## Output formats
* PNG
* SVG

## Font
OCR-B font from https://github.com/opensourcedesign/fonts

## Example
    $barcode = \Jbarc\Barcode\Factory::getBarcode('EAN13', '5901234123457');
    $image = \Jbarc\Barcode\Factory::getRenderedImage($barcode, 'png', 2, 100);
    file_put_contents(__DIR__ . '/testEan13.png', $image);
