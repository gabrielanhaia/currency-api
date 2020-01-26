<?php


namespace App\Service\Processor\Factory;

use App\Models\Transaction;
use App\Service\Processor\ProcessorStrategy\IProcessor;

/**
 * Interface IProcessorFactory.
 * Base interface for the factories responsible for creating the processor jobs.
 *
 * @package App\Service\Processor\Factory
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
interface IProcessorFactory
{
    public function makeProcessor(Transaction $transaction): IProcessor;
}
