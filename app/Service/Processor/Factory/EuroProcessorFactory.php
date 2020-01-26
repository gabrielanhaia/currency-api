<?php


namespace App\Service\Processor\Factory;

use App\Models\Transaction;
use App\Service\Processor\ProcessorStrategy\IProcessor;
use App\Service\Processor\ProcessorStrategy\EuroProcessor;

/**
 * Class EuroProcessorFactory
 * @package App\Service\Processor\Factory
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class EuroProcessorFactory implements IProcessorFactory
{
    /**
     * @param Transaction $transaction
     * @return IProcessor|EuroProcessor
     */
    public function makeProcessor(Transaction $transaction): IProcessor
    {
        return new EuroProcessor($transaction);
    }
}
