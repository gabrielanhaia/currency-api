<?php


namespace App\Service\Processor\Factory;


use App\Models\Transaction;
use App\Service\Processor\ProcessorStrategy\IProcessor;
use App\Service\Processor\ProcessorStrategy\BrazilianRealProcessor;

/**
 * Class BrazilianRealProcessorFactory responsible for creating the factory for Brazilian Real integration.
 * @package App\Service\Processor\Factory
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class BrazilianRealProcessorFactory implements IProcessorFactory
{
    /**
     * @param Transaction $transaction
     * @return IProcessor|BrazilianRealProcessor
     */
    public function makeProcessor(Transaction $transaction): IProcessor
    {
        return new BrazilianRealProcessor($transaction);
    }
}
