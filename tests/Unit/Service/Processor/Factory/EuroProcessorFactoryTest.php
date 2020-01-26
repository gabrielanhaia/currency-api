<?php


namespace Tests\Unit\Service\Processor\Factory;

use App\Models\Transaction;
use App\Service\Processor\Factory\BrazilianRealProcessorFactory;
use App\Service\Processor\Factory\EuroProcessorFactory;
use App\Service\Processor\ProcessorStrategy\BrazilianRealProcessor;
use App\Service\Processor\ProcessorStrategy\EuroProcessor;
use Tests\TestCase;

/**
 * Class EuroProcessorFactoryTest
 * @package Tests\Unit\Service\Processor\Factory
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class EuroProcessorFactoryTest extends TestCase
{
    /**
     * Test success creating the euro processor using its factory.
     */
    public function testSuccessCreatingeurorocessor()
    {
        $transactionModelMock = \Mockery::mock(Transaction::class);

        $euroProcessorFactory = new EuroProcessorFactory;
        $euroProcessor = $euroProcessorFactory->makeProcessor($transactionModelMock);

        $expectedResult = new EuroProcessor($transactionModelMock);
        $this->assertEquals($expectedResult, $euroProcessor);
    }
}
