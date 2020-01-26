<?php


namespace App\Service\Processor\Factory;

use App\Models\Transaction;
use App\Service\Processor\ProcessorStrategy\IProcessor;
use App\Service\Processor\ProcessorStrategy\PoundsProcessor;

/**
 * Class PoundsProcessorFactory
 * @package App\Service\Processor\Factory
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class PoundsProcessorFactory implements IProcessorFactory
{
    /**
     * @param Transaction $transaction
     * @return IProcessor|PoundsProcessor
     */
    public function makeProcessor(Transaction $transaction): IProcessor
    {
        return new PoundsProcessor($transaction);
    }
}
