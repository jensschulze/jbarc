<?php

namespace Jbarc\Barcode\Generator;

use Jbarc\Barcode\Bar;
use Jbarc\Barcode\Barcode1d;
use Jbarc\Exception\OutOfBoundsException;

class Code39 extends AbstractGenerator1d
{
    public function generate($data, Barcode1d $barcode): Barcode1d
    {
        $barcode->setRawData($data);

        $chr['0'] = '111331311';
        $chr['1'] = '311311113';
        $chr['2'] = '113311113';
        $chr['3'] = '313311111';
        $chr['4'] = '111331113';
        $chr['5'] = '311331111';
        $chr['6'] = '113331111';
        $chr['7'] = '111311313';
        $chr['8'] = '311311311';
        $chr['9'] = '113311311';
        $chr['A'] = '311113113';
        $chr['B'] = '113113113';
        $chr['C'] = '313113111';
        $chr['D'] = '111133113';
        $chr['E'] = '311133111';
        $chr['F'] = '113133111';
        $chr['G'] = '111113313';
        $chr['H'] = '311113311';
        $chr['I'] = '113113311';
        $chr['J'] = '111133311';
        $chr['K'] = '311111133';
        $chr['L'] = '113111133';
        $chr['M'] = '313111131';
        $chr['N'] = '111131133';
        $chr['O'] = '311131131';
        $chr['P'] = '113131131';
        $chr['Q'] = '111111333';
        $chr['R'] = '311111331';
        $chr['S'] = '113111331';
        $chr['T'] = '111131331';
        $chr['U'] = '331111113';
        $chr['V'] = '133111113';
        $chr['W'] = '333111111';
        $chr['X'] = '131131113';
        $chr['Y'] = '331131111';
        $chr['Z'] = '133131111';
        $chr['-'] = '131111313';
        $chr['.'] = '331111311';
        $chr[' '] = '133111311';
        $chr['$'] = '131313111';
        $chr['/'] = '131311131';
        $chr['+'] = '131113131';
        $chr['%'] = '111313131';
        $chr['*'] = '131131311';

        // add start and stop codes
        $data = "*{$this->process->getProcessedData($data)}*";

        $barcode
            ->setData($data)
            ->setMaxWidth(0)
            ->setMaxHeight(1);

        $k    = 0;
        $clen = strlen($data);

        for ($i = 0; $i < $clen; ++$i) {
            $char = $data{$i};
            if (!isset($chr[$char])) {
                // invalid character
                throw new OutOfBoundsException("Invalid character '$char''");
            }

            for ($j = 0; $j < 9; ++$j) {
                $t = Bar::SPACE;
                if (0 === ($j % 2)) {
                    $t = Bar::BAR;
                }
                $w = (int) $chr[$char]{$j};
                $barcode
                    ->addBar(new Bar($t, $w, 1, 0))
                    ->increaseMaxWidth($w);
                ++$k;
            }

            // intercharacter gap
            $barcode
                ->addBar(new Bar(false, 10, 1, 0))
                ->increaseMaxWidth(10);
            ++$k;
        }

        return $barcode;
    }
}
