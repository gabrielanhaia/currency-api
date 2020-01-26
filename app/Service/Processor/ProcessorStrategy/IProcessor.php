<?php


namespace App\Service\Processor\ProcessorStrategy;


use App\Models\Transaction;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class IProcessor
 * @package App\Service\Processor\ProcessorStrategy
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
abstract class IProcessor implements ShouldQueue
{
    /** @var Transaction $transaction Object/model with the transaction data. */
    protected $transaction;

    /**
     * IProcessor constructor.
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }
}
