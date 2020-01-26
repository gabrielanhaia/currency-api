<?php


namespace Tests\Unit\Service\Processor\Factory;

use App\Models\Transaction;
use App\Service\Processor\Factory\BrazilianRealProcessorFactory;
use App\Service\Processor\ProcessorStrategy\BrazilianRealProcessor;
use Tests\TestCase;

/**
 * Class BrazilianRealProcessorFactoryTest
 * @package Tests\Unit\Service\Processor\Factory
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class BrazilianRealProcessorFactoryTest extends TestCase
{
    /**
     * Test success creating the brazilian real processor using its factory.
     */
    public function testSuccessCreatingBrazilianRealProcessor()
    {
        $transactionModelMock = \Mockery::mock(Transaction::class);

        $brazilianRealProcessorFactory = new BrazilianRealProcessorFactory;
        $brazilianRealProcessor = $brazilianRealProcessorFactory->makeProcessor($transactionModelMock);

        $expectedResult = new BrazilianRealProcessor($transactionModelMock);
        $this->assertEquals($expectedResult, $brazilianRealProcessor);
    }
}
