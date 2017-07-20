<?php

declare(strict_types=1);

namespace Jbarc\Barcode\Generator;

use Jbarc\Barcode\Bar;
use Jbarc\Barcode\Barcode1d;
use Jbarc\Exception\InvalidChecksumException;

class EanUpc extends AbstractGenerator1d
{
    public function generate(string $data, Barcode1d $barcode): Barcode1d
    {
        $barcode->setRawData($data);

        $len  = strlen($data);
        $upce = false;
        if (6 === $len) {
            $len  = 12; // UPC-A
            $upce = true; // UPC-E mode
        }

        $data_len = $len - 1;

        //Padding
        $data     = str_pad($data, $data_len, '0', STR_PAD_LEFT);
        $code_len = strlen($data);
        // calculate check digit
        $sum_a = 0;
        for ($i = 1; $i < $data_len; $i += 2) {
            $sum_a += $data{$i};
        }
        if ($len > 12) {
            $sum_a *= 3;
        }
        $sum_b = 0;
        for ($i = 0; $i < $data_len; $i += 2) {
            $sum_b += ($data{$i});
        }
        if ($len < 13) {
            $sum_b *= 3;
        }
        $r = ($sum_a + $sum_b) % 10;
        if ($r > 0) {
            $r = (10 - $r);
        }
        if ($code_len === $data_len) {
            // add check digit
            $data .= $r;
        } elseif ($r !== (int) $data{$data_len}) {
            // wrong checkdigit
            throw new InvalidChecksumException();
        }
        if (12 === $len) {
            // UPC-A
            $data = '0'.$data;
            ++$len;
        }
        if ($upce) {
            // convert UPC-A to UPC-E
            $tmp = substr($data, 4, 3);
            if (('000' === $tmp) || ('100' === $tmp) || ('200' === $tmp)) {
                // manufacturer code ends in 000, 100, or 200
                $upce_code = substr($data, 2, 2).substr($data,9,3).substr($data, 4, 1);
            } else {
                $tmp = substr($data, 5, 2);
                if ('00' === $tmp) {
                    // manufacturer code ends in 00
                    $upce_code = substr($data, 2, 3).substr($data,10,2).'3';
                } else {
                    $tmp = substr($data, 6, 1);
                    if ('0' === $tmp) {
                        // manufacturer code ends in 0
                        $upce_code = substr($data, 2, 4).substr($data,11,1).'4';
                    } else {
                        // manufacturer code does not end in zero
                        $upce_code = substr($data, 2, 5).substr($data, 11, 1);
                    }
                }
            }
        }
        //Convert digits to bars
        $codes            = [
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
        $parities         = [
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
        $upce_parities    = [];
        $upce_parities[0] = [
            '0' => ['B', 'B', 'B', 'A', 'A', 'A'],
            '1' => ['B', 'B', 'A', 'B', 'A', 'A'],
            '2' => ['B', 'B', 'A', 'A', 'B', 'A'],
            '3' => ['B', 'B', 'A', 'A', 'A', 'B'],
            '4' => ['B', 'A', 'B', 'B', 'A', 'A'],
            '5' => ['B', 'A', 'A', 'B', 'B', 'A'],
            '6' => ['B', 'A', 'A', 'A', 'B', 'B'],
            '7' => ['B', 'A', 'B', 'A', 'B', 'A'],
            '8' => ['B', 'A', 'B', 'A', 'A', 'B'],
            '9' => ['B', 'A', 'A', 'B', 'A', 'B'],
        ];
        $upce_parities[1] = [
            '0' => ['A', 'A', 'A', 'B', 'B', 'B'],
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
        $k                = 0;
        $seq              = '101'; // left guard bar
        if ($upce) {
            $barcode->setData($upce_code)->setMaxHeight(1);
            $p = $upce_parities[$data[1]][$r];
            for ($i = 0; $i < 6; ++$i) {
                $seq .= $codes[$p[$i]][$upce_code{$i}];
            }
            $seq .= '010101'; // right guard bar
        } else {
            $barcode->setData($data)->setMaxHeight(1);
            $half_len = (int) ceil($len / 2);
            if ($len == 8) {
                for ($i = 0; $i < $half_len; ++$i) {
                    $seq .= $codes['A'][$data{$i}];
                }
            } else {
                $p = $parities[$data[0]];
                for ($i = 1; $i < $half_len; ++$i) {
                    $seq .= $codes[$p[$i - 1]][$data{$i}];
                }
            }
            $seq .= '01010'; // center guard bar
            for ($i = $half_len; $i < $len; ++$i) {
                $seq .= $codes['C'][$data{$i}];
            }
            $seq .= '101'; // right guard bar
        }
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
                $barcode->addBar(new Bar($t, $w, 1, 0));
                ++$k;
                $w = 0;
            }
        }

        return $barcode;
    }
}