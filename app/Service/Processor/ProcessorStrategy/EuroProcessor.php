<?php

namespace App\Service\Processor\ProcessorStrategy;

use App\Repositories\TransactionRepository;
use CurrencyFair\IntegrationIrishBank\Integration\Client;
use CurrencyFair\IntegrationIrishBank\Integration\Entity\AccountEntity;
use CurrencyFair\IntegrationIrishBank\Integration\Entity\TransferEntity;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class EuroProcessor
 * @package App\Services\Processor\ProcessorStrategy
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class EuroProcessor extends IProcessor
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
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
            ->setIban(123212);

        $accountDestination = new AccountEntity;
        $accountDestination->setName('THIS DATA SHOULD COME FROM THE USER RELATED (It wasn\'t implemented.)')
            ->setIban(11122);

        $transferEntity->setAccountOrigin($accountOrigin)
            ->setAccountDestination($accountDestination)
            ->setTotal($totalTransaction);

        $client->makeTransfer($transferEntity);

        $transactionRepository->setTransactionAsProcessed($this->transaction->id);
    }
}
