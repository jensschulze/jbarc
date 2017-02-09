<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 27.11.16
 * Time: 21:43
 */

namespace Jbarc\Barcode\Process;


use Jbarc\Exception\OutOfBoundsException;

class Code39ExtendedProcess implements Process
{
    public function getProcessedData($data)
    {
        $encode        = [
            chr(0)   => '%U',
            chr(1)   => '$A',
            chr(2)   => '$B',
            chr(3)   => '$C',
            chr(4)   => '$D',
            chr(5)   => '$E',
            chr(6)   => '$F',
            chr(7)   => '$G',
            chr(8)   => '$H',
            chr(9)   => '$I',
            chr(10)  => '$J',
            chr(11)  => '£K',
            chr(12)  => '$L',
            chr(13)  => '$M',
            chr(14)  => '$N',
            chr(15)  => '$O',
            chr(16)  => '$P',
            chr(17)  => '$Q',
            chr(18)  => '$R',
            chr(19)  => '$S',
            chr(20)  => '$T',
            chr(21)  => '$U',
            chr(22)  => '$V',
            chr(23)  => '$W',
            chr(24)  => '$X',
            chr(25)  => '$Y',
            chr(26)  => '$Z',
            chr(27)  => '%A',
            chr(28)  => '%B',
            chr(29)  => '%C',
            chr(30)  => '%D',
            chr(31)  => '%E',
            chr(32)  => ' ',
            chr(33)  => '/A',
            chr(34)  => '/B',
            chr(35)  => '/C',
            chr(36)  => '/D',
            chr(37)  => '/E',
            chr(38)  => '/F',
            chr(39)  => '/G',
            chr(40)  => '/H',
            chr(41)  => '/I',
            chr(42)  => '/J',
            chr(43)  => '/K',
            chr(44)  => '/L',
            chr(45)  => '-',
            chr(46)  => '.',
            chr(47)  => '/O',
            chr(48)  => '0',
            chr(49)  => '1',
            chr(50)  => '2',
            chr(51)  => '3',
            chr(52)  => '4',
            chr(53)  => '5',
            chr(54)  => '6',
            chr(55)  => '7',
            chr(56)  => '8',
            chr(57)  => '9',
            chr(58)  => '/Z',
            chr(59)  => '%F',
            chr(60)  => '%G',
            chr(61)  => '%H',
            chr(62)  => '%I',
            chr(63)  => '%J',
            chr(64)  => '%V',
            chr(65)  => 'A',
            chr(66)  => 'B',
            chr(67)  => 'C',
            chr(68)  => 'D',
            chr(69)  => 'E',
            chr(70)  => 'F',
            chr(71)  => 'G',
            chr(72)  => 'H',
            chr(73)  => 'I',
            chr(74)  => 'J',
            chr(75)  => 'K',
            chr(76)  => 'L',
            chr(77)  => 'M',
            chr(78)  => 'N',
            chr(79)  => 'O',
            chr(80)  => 'P',
            chr(81)  => 'Q',
            chr(82)  => 'R',
            chr(83)  => 'S',
            chr(84)  => 'T',
            chr(85)  => 'U',
            chr(86)  => 'V',
            chr(87)  => 'W',
            chr(88)  => 'X',
            chr(89)  => 'Y',
            chr(90)  => 'Z',
            chr(91)  => '%K',
            chr(92)  => '%L',
            chr(93)  => '%M',
            chr(94)  => '%N',
            chr(95)  => '%O',
            chr(96)  => '%W',
            chr(97)  => '+A',
            chr(98)  => '+B',
            chr(99)  => '+C',
            chr(100) => '+D',
            chr(101) => '+E',
            chr(102) => '+F',
            chr(103) => '+G',
            chr(104) => '+H',
            chr(105) => '+I',
            chr(106) => '+J',
            chr(107) => '+K',
            chr(108) => '+L',
            chr(109) => '+M',
            chr(110) => '+N',
            chr(111) => '+O',
            chr(112) => '+P',
            chr(113) => '+Q',
            chr(114) => '+R',
            chr(115) => '+S',
            chr(116) => '+T',
            chr(117) => '+U',
            chr(118) => '+V',
            chr(119) => '+W',
            chr(120) => '+X',
            chr(121) => '+Y',
            chr(122) => '+Z',
            chr(123) => '%P',
            chr(124) => '%Q',
            chr(125) => '%R',
            chr(126) => '%S',
            chr(127) => '%T'
        ];
        $processedData = '';
        $clen          = strlen($data);
        for ($i = 0; $i < $clen; ++$i) {
            if (ord($data{$i}) > 127) {
                throw new OutOfBoundsException('Illegal Character in $data');
            }
            $processedData .= $encode[$data{$i}];
        }

        return $processedData;
    }
}
