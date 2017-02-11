<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 11.02.17
 * Time: 16:32
 */

namespace Jbarc\Barcode\Process;


use PHPUnit\Framework\TestCase;

class UppercaseProcessTest extends TestCase
{
    /**
     * @var UppercaseProcess
     */
    private $process;


    public function setUp()
    {
        $this->process = new UppercaseProcess();
    }


    /**
     * @test
     */
    public function processZeroLength()
    {
        $input = '';

        $this->assertSame($input, $this->process->getProcessedData($input));
    }


    /**
     * @test
     */
    public function processNumbers()
    {
        $input = '12345';

        $this->assertSame($input, $this->process->getProcessedData($input));
    }


    /**
     * @test
     */
    public function processLetters()
    {
        $input  = 'aBcDeF';
        $output = 'ABCDEF';

        $this->assertSame($output, $this->process->getProcessedData($input));
    }
}
