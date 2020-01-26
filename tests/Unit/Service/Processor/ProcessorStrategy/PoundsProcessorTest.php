<?php


namespace Tests\Unit\Service\Processor\ProcessorStrategy;

use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use App\Service\Processor\ProcessorStrategy\EuroProcessor;
use App\Service\Processor\ProcessorStrategy\PoundsProcessor;
use CurrencyFair\IntegrationIrishBank\{Integration\Client,
    Integration\Entity\AccountEntity,
    Integration\Entity\TransferEntity};
use Tests\TestCase;

/**
 * Class PoundsProcessorTest
 * @package Tests\Unit\Service\Processor\ProcessorStrategy
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class PoundsProcessorTest extends TestCase
{
    /**
     * Method responsible for processing a Pound transaction.
     */
    public function testSuccessProcessingPoundsTransaction()
    {
        $transactionId = 231321322;
        $amountBuy = 130.1;

        $transactionModelModel = \Mockery::mock(Transaction::class);
        $transactionModelModel->expects('getAttribute')
            ->once()
            ->with('id')
            ->andReturn($transactionId);

        $transactionModelModel->expects('getAttribute')
            ->once()
            ->with('amount_buy')
            ->andReturn($amountBuy);

        $transferEntity = new TransferEntity;
        $accountOrigin = new AccountEntity;
        $accountOrigin->setName('THIS DATA SHOULD COME FROM A CONFIGURATION (Currency Fair Account)')
            ->setIban(123212);

        $accountDestination = new AccountEntity;
        $accountDestination->setName('THIS DATA SHOULD COME FROM THE USER RELATED (It wasn\'t implemented.)')
            ->setIban(11122);

        $transferEntity->setAccountOrigin($accountOrigin)
            ->setAccountDestination($accountDestination)
            ->setTotal($amountBuy);

        $clientIrishBankMock = \Mockery::mock(Client::class);
        $clientIrishBankMock->expects('makeTransfer')
            ->once()
            ->with(\Mockery::on(function($arg) use ($transferEntity) {
                return ($transferEntity == $arg);
            }))
            ->andReturnSelf();

        $transactionRepository = \Mockery::mock(TransactionRepository::class);
        $transactionRepository->expects('setTransactionAsProcessed')
            ->with($transactionId)
            ->once()
            ->andReturnTrue();

        $euroProcessor = new PoundsProcessor($transactionModelModel);
        $response = $euroProcessor->handle($clientIrishBankMock, $transactionRepository);

        $this->assertNull($response);
    }
}
