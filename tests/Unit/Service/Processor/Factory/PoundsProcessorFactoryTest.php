<?php


namespace Tests\Unit\Service\Processor\Factory;

use App\Models\Transaction;
use App\Service\Processor\Factory\BrazilianRealProcessorFactory;
use App\Service\Processor\Factory\PoundsProcessorFactory;
use App\Service\Processor\ProcessorStrategy\BrazilianRealProcessor;
use App\Service\Processor\ProcessorStrategy\PoundsProcessor;
use Tests\TestCase;

/**
 * Class PoundsProcessorFactoryTest
 * @package Tests\Unit\Service\Processor\Factory
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class PoundsProcessorFactoryTest extends TestCase
{
    /**
     * Test success creating the pounds processor using its factory.
     */
    public function testSuccessCreatingPoundsProcessor()
    {
        $transactionModelMock = \Mockery::mock(Transaction::class);

        $poundsProcessorFactory = new PoundsProcessorFactory;
        $poundsProcessor = $poundsProcessorFactory->makeProcessor($transactionModelMock);

        $expectedResult = new PoundsProcessor($transactionModelMock);
        $this->assertEquals($expectedResult, $poundsProcessor);
    }
}
