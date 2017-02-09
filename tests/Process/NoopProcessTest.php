<?php
/**
 * Created by PhpStorm.
 * User: jensschulze
 * Date: 05.02.17
 * Time: 20:51
 */

namespace JbarcTest\Process;


use Jbarc\Barcode\Process\NoopProcess;
use PHPUnit\Framework\TestCase;

class NoopProcessTest extends TestCase
{
    /**
     * @var NoopProcess
     */
    private $process;

    public function setUp()
    {
        $this->process = new NoopProcess();
    }


    /**
     * @test
     */
    public function processPositive() {
        $input = 'testdata';
        $this-> assertSame($input, $this->process->getProcessedData($input));
    }
}