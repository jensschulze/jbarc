<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 05.02.17
 * Time: 20:51
 */

namespace Jbarc\Barcode\Process;


use PHPUnit\Framework\TestCase;

class ZeroPaddingProcessTest extends TestCase
{
    /**
     * @var ZeroPaddingProcess
     */
    private $process;


    public function setUp()
    {
        $this->process = new ZeroPaddingProcess();
    }


    /**
     * @test
     */
    public function processZeroLength()
    {
        $input = '12345';

        $this->process->setPadLength(0);
        $this->assertSame($input, $this->process->getProcessedData($input));
    }


    /**
     * @test
     */
    public function processEqualLength()
    {
        $input = '12345';

        $this->process->setPadLength(5);
        $this->assertSame($input, $this->process->getProcessedData($input));
    }


    /**
     * @test
     */
    public function processPadding()
    {
        $input = '12345';

        $this->process->setPadLength(10);
        $this->assertSame('0000012345', $this->process->getProcessedData($input));
    }
}