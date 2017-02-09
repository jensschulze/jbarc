<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 29.11.16
 * Time: 23:12
 */

namespace Jbarc\Barcode\Generator;


use Jbarc\Barcode\Bar;
use Jbarc\Barcode\Barcode1d;
use Jbarc\Exception\InvalidChecksumException;

class Ean13 extends AbstractGenerator1d
{
    public function generate($data, Barcode1d $barcode)
    {
        $barcode->setRawData($data);

        $len = strlen($data);
        $data_len = $len - 1;

        // calculate check digit
        $sum_a = 0;
        for ($i = 1; $i < $data_len; $i += 2) {
            $sum_a += $data{$i};
        }
            $sum_a *= 3;
        $sum_b = 0;
        for ($i = 0; $i < $data_len; $i += 2) {
            $sum_b += ($data{$i});
        }
        $r = ($sum_a + $sum_b) % 10;
        if ($r > 0) {
            $r = (10 - $r);
        }
        if ($r !== (int) $data{$data_len}) {
            // wrong checkdigit
            throw new InvalidChecksumException();
        }
        //Convert digits to bars
        $codes    = [
            'A' => [ // left odd parity
                     '0' => '0001101',
                     '1' => '0011001',
                     '2' => '0010011',
                     '3' => '0111101',
                     '4' => '0100011',
                     '5' => '0110001',
                     '6' => '0101111',
                     '7' => '0111011',
                     '8' => '0110111',
                     '9' => '0001011',
            ],
            'B' => [ // left even parity
                     '0' => '0100111',
                     '1' => '0110011',
                     '2' => '0011011',
                     '3' => '0100001',
                     '4' => '0011101',
                     '5' => '0111001',
                     '6' => '0000101',
                     '7' => '0010001',
                     '8' => '0001001',
                     '9' => '0010111',
            ],
            'C' => [ // right
                     '0' => '1110010',
                     '1' => '1100110',
                     '2' => '1101100',
                     '3' => '1000010',
                     '4' => '1011100',
                     '5' => '1001110',
                     '6' => '1010000',
                     '7' => '1000100',
                     '8' => '1001000',
                     '9' => '1110100',
            ],
        ];
        $parities = [
            '0' => ['A', 'A', 'A', 'A', 'A', 'A'],
            '1' => ['A', 'A', 'B', 'A', 'B', 'B'],
            '2' => ['A', 'A', 'B', 'B', 'A', 'B'],
            '3' => ['A', 'A', 'B', 'B', 'B', 'A'],
            '4' => ['A', 'B', 'A', 'A', 'B', 'B'],
            '5' => ['A', 'B', 'B', 'A', 'A', 'B'],
            '6' => ['A', 'B', 'B', 'B', 'A', 'A'],
            '7' => ['A', 'B', 'A', 'B', 'A', 'B'],
            '8' => ['A', 'B', 'A', 'B', 'B', 'A'],
            '9' => ['A', 'B', 'B', 'A', 'B', 'A'],
        ];
        $k        = 0;
        $seq      = '101'; // left guard bar
        $barcode->setData($data)->setMaxHeight(1);
        $half_len = (int) ceil($len / 2);
            $p = $parities[$data[0]];
            for ($i = 1; $i < $half_len; ++$i) {
                $seq .= $codes[$p[$i - 1]][$data{$i}];
            }

        $seq .= '01010'; // center guard bar
        for ($i = $half_len; $i < $len; ++$i) {
            $seq .= $codes['C'][$data{$i}];
        }
        $seq .= '101'; // right guard bar

        $clen = strlen($seq);
        $w    = 0;
        for ($i = 0; $i < $clen; ++$i) {
            $w += 1;
            if (($i == ($clen - 1)) OR (($i < ($clen - 1)) AND ($seq{$i} != $seq{($i + 1)}))) {
                if ($seq{$i} == '1') {
                    $t = true; // bar
                } else {
                    $t = false; // space
                }
                $barcode->addBar(new Bar($t, $w, 1, 0))->increaseMaxWidth($w);
                ++$k;
                $w = 0;
            }
        }

        return $barcode;
    }
}