<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 27.11.16
 * Time: 21:26
 */

namespace Jbarc\Barcode;


use Jbarc\Barcode\Generator\Code39;
use Jbarc\Barcode\Generator\Ean13;
use Jbarc\Barcode\Process\ChainProcess;
use Jbarc\Barcode\Process\Code39Checksum;
use Jbarc\Barcode\Process\Code39ExtendedProcess;
use Jbarc\Barcode\Process\UppercaseProcess;
use Jbarc\Barcode\Process\ZeroPaddingProcess;
use Jbarc\Color\Color;
use Jbarc\Color\RgbColor;
use Jbarc\Exception\ExtensionNotFoundException;
use Jbarc\Exception\InvalidArgumentException;
use Jbarc\Barcode\Renderer\PngRenderer;

class Factory
{
    private function __constructor()
    {
    }


    /**
     * @param string $name
     * @param string $data
     *
     * @return Barcode
     * @throws InvalidArgumentException
     */
    public static function getBarcode($name, $data)
    {
        switch (strtoupper($name)) {
            case 'C39': { // CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
                $process   = new UppercaseProcess();
                $generator = new Code39($process);
                break;
            }
            case 'C39+': { // CODE 39 with checksum
                $process   = (new ChainProcess())
                    ->addProcess(new UppercaseProcess())
                    ->addProcess(new Code39Checksum());
                $generator = new Code39($process);
                break;
            }
            case 'C39E': { // CODE 39 EXTENDED
                $process   = new Code39ExtendedProcess();
                $generator = new Code39($process);
                break;
            }
            case 'C39E+': { // CODE 39 EXTENDED + CHECKSUM
                $process   = (new ChainProcess())
                    ->addProcess(new Code39ExtendedProcess())
                    ->addProcess(new Code39Checksum());
                $generator = new Code39($process);
                break;
            }
            case 'C93': { // CODE 93 - USS-93
//                $arrcode = $this->barcode_code93($code);
                break;
            }
            case 'S25': { // Standard 2 of 5
//                $arrcode = $this->barcode_s25($code, false);
                break;
            }
            case 'S25+': { // Standard 2 of 5 + CHECKSUM
//                $arrcode = $this->barcode_s25($code, true);
                break;
            }
            case 'I25': { // Interleaved 2 of 5
//                $arrcode = $this->barcode_i25($code, false);
                break;
            }
            case 'I25+': { // Interleaved 2 of 5 + CHECKSUM
//                $arrcode = $this->barcode_i25($code, true);
                break;
            }
            case 'C128': { // CODE 128
//                $arrcode = $this->barcode_c128($code, '');
                break;
            }
            case 'C128A': { // CODE 128 A
//                $arrcode = $this->barcode_c128($code, 'A');
                break;
            }
            case 'C128B': { // CODE 128 B
//                $arrcode = $this->barcode_c128($code, 'B');
                break;
            }
            case 'C128C': { // CODE 128 C
//                $arrcode = $this->barcode_c128($code, 'C');
                break;
            }
            case 'EAN2': { // 2-Digits UPC-Based Extension
//                $arrcode = $this->barcode_eanext($code, 2);
                break;
            }
            case 'EAN5': { // 5-Digits UPC-Based Extension
//                $arrcode = $this->barcode_eanext($code, 5);
                break;
            }
            case 'EAN8': { // EAN 8
                $pad     = (new ZeroPaddingProcess())->setPadLength(8);
                $process = new ChainProcess([$pad,]);

//                $arrcode = $this->barcode_eanupc($code, 8);
                break;
            }
            case 'EAN13': { // EAN 13
                $process   = (new ZeroPaddingProcess())->setPadLength(13);
                $generator = new Ean13($process);
                break;
            }
            case 'UPCA': { // UPC-A
//                $arrcode = $this->barcode_eanupc($code, 12);
                break;
            }
            case 'UPCE': { // UPC-E
//                $arrcode = $this->barcode_eanupc($code, 6);
                break;
            }
            case 'MSI': { // MSI (Variation of Plessey code)
//                $arrcode = $this->barcode_msi($code, false);
                break;
            }
            case 'MSI+': { // MSI + CHECKSUM (modulo 11)
//                $arrcode = $this->barcode_msi($code, true);
                break;
            }
            case 'POSTNET': { // POSTNET
//                $arrcode = $this->barcode_postnet($code, false);
                break;
            }
            case 'PLANET': { // PLANET
//                $arrcode = $this->barcode_postnet($code, true);
                break;
            }
            case 'RMS4CC': { // RMS4CC (Royal Mail 4-state Customer Code) - CBC (Customer Bar Code)
//                $arrcode = $this->barcode_rms4cc($code, false);
                break;
            }
            case 'KIX': { // KIX (Klant index - Customer index)
//                $arrcode = $this->barcode_rms4cc($code, true);
                break;
            }
            case 'IMB': { // IMB - Intelligent Mail Barcode - Onecode - USPS-B-3200
//                $arrcode = $this->barcode_imb($code);
                break;
            }
            case 'IMBPRE': { // IMB - Intelligent Mail Barcode - Onecode - USPS-B-3200- pre-processed
//                $arrcode = $this->barcode_imb_pre($code);
                break;
            }
            case 'CODABAR': { // CODABAR
//                $arrcode = $this->barcode_codabar($code);
                break;
            }
            case 'CODE11': { // CODE 11
//                $arrcode = $this->barcode_code11($code);
                break;
            }
            case 'PHARMA': { // PHARMACODE
//                $arrcode = $this->barcode_pharmacode($code);
                break;
            }
            case 'PHARMA2T': { // PHARMACODE TWO-TRACKS
//                $arrcode = $this->barcode_pharmacode2t($code);
                break;
            }
            default:
                throw new InvalidArgumentException(
                    "Barcode type '$name' unknown"
                );
                break;
        }

        $barcode = new Barcode1d();

        return $generator->generate($data, $barcode);
    }


    /**
     * @param string  $type
     * @param Barcode $barcode
     * @param int     $width
     * @param int     $height
     * @param Color   $color
     *
     * @return mixed
     * @throws ExtensionNotFoundException
     */
    public static function getRenderedImage(
        Barcode $barcode,
        $type = 'png',
        $width = 2,
        $height = 30,
        Color $color = null
    ) {
        switch (true) {
            case (extension_loaded('imagick')):
                $specificDriver = '\\Jbarc\\Barcode\\ImageDriver\\ImagickDriver';
                break;
            case (function_exists('imagecreate')):
                $specificDriver = '\\Jbarc\\Barcode\\ImageDriver\\GdDriver';
                break;
            default:
                throw new ExtensionNotFoundException(
                    'Did not find Imagick or GD PHP extension'
                );
        }

        switch (strtolower($type)) {
            case 'png':
                $driver   = new $specificDriver();
                $renderer = new PngRenderer($driver);
                break;
            default:
                throw new InvalidArgumentException(
                    "Invalid output type '$type'"
                );
        }

        if (null === $color) {
            $color = new RgbColor(0, 0, 0);
        }
        $image = $renderer->render($barcode, $width, $height, $color);

        return $image;
    }
}