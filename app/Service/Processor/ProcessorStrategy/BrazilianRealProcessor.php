<?php

namespace App\Service\Processor\ProcessorStrategy;

use App\Repositories\TransactionRepository;
use CurrencyFair\IntegrationBrazillianBank\{Integration\Client,
    Integration\Entity\AccountEntity,
    Integration\Entity\TransferEntity};
use Illuminate\{Bus\Queueable, Foundation\Bus\Dispatchable, Queue\InteractsWithQueue, Queue\SerializesModels};

/**
 * Class BrazilianRealProcessor
 * @package App\Services\Processor\ProcessorStrategy
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class BrazilianRealProcessor extends IProcessor
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Note: The implementation is different as Euro or Pounds.
     *
     * @param Client $client
     * @param TransactionRepository $transactionRepository
     * @throws \Exception
     */
    public function handle(Client $client, TransactionRepository $transactionRepository)
    {
        $totalTransaction = $this->transaction->amount_buy;

        $transferEntity = new TransferEntity;

        $accountOrigin = new AccountEntity;
        $accountOrigin->setName('THIS DATA SHOULD COME FROM A CONFIGURATION (Currency Fair Account)')
            ->setAgencyNumber(141)
            ->setAccountNumber(44124);

        $accountDestination = new AccountEntity;
        $accountDestination->setName('THIS DATA SHOULD COME FROM THE USER RELATED (It wasn\'t implemented.)')
            ->setAgencyNumber(155)
            ->setAccountNumber(44414);

        $transferEntity->setAccountOrigin($accountOrigin)
            ->setAccountDestination($accountDestination)
            ->setTotal($totalTransaction);

        $client->makeTransfer($transferEntity);

        $transactionRepository->setTransactionAsProcessed($this->transaction->id);
    }
}
