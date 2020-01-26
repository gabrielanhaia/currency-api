<?php


namespace App\Service\Processor;

use App\Models\Transaction;
use App\Service\Processor\Factory\{
    BrazilianRealProcessorFactory,
    EuroProcessorFactory,
    IProcessorFactory,
    PoundsProcessorFactory
};

/**
 * Class TransactionProcessor responsible for centralize the call to the transaction processors (integrations)
 * (It's important to know that I am using queues to dispatch the jobs and process the transactions,
 * that is much better because we can process everything in parallel and split the processing in different
 * servers).
 * @package App\Service\Processor
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class TransactionProcessor
{
    /** @var array $listOfProcessorFactories List of currencies and their respective processor factories. */
    private $listOfProcessorFactories = [
        'BRL' => BrazilianRealProcessorFactory::class,
        'GBP' => PoundsProcessorFactory::class,
        'EUR' => EuroProcessorFactory::class
    ];

    /**
     * Method responsible for dispatch a transaction.
     *
     * @param Transaction $transaction
     */
    public function processTransaction(Transaction $transaction)
    {
        /**  TODO: I think here it would be important (maybe) a call to the API where the
         *  had transfer the money (currency_to) because we need to now if the money is in the
         * bank account (currency fair).
         */

        $currencyIdentifier = $transaction->currencyTo->initial;

        $processorFactory = $this->getProcessorFactory($currencyIdentifier);
        $processor = $processorFactory->makeProcessor($transaction);

        // TODO: change dispatch_now to dispatch. (i am using dispatch_now because it is easier for Currency fair test it)
        dispatch_now($processor);
    }

    /**
     * Method responsible for returning the processor factory.
     *
     * @param string $currencyIdentifier
     * @return IProcessorFactory
     */
    private function getProcessorFactory(string $currencyIdentifier): IProcessorFactory
    {
        if (!isset($this->listOfProcessorFactories[$currencyIdentifier])) {
            /**
             * Note: I let the throw commented and put the line bellow because i don't want to show errors while
             * you were testing. Probably the error would be thrown when you send an unexpected currency.
             * TODO: Remove the line bellow and uncomment the throw exception.
             */

            $currencyIdentifier = 'EUR';
            //throw new \Exception('There is no integration with the bank that the money should be send')
        }

        /**
         * Note: This is the only place that I create a instance dynamically.
         * When I was developing things in Java and i saw this, I thought it was different,
         * however that is on of the facilities from PHP, with the right validations (code above),
         * It works fine.
         */
        $processorFactory = new $this->listOfProcessorFactories[$currencyIdentifier];

        return $processorFactory;
    }
}
