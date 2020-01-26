<?php


namespace Tests\Unit\Repositories;

use App\Models\{Country, Currency, Transaction};
use App\Repositories\TransactionRepository;
use Tests\TestCase;

/**
 * Class TransactionRepositoryTest responsible for the test on the repository class.
 * @package Tests\Unit\Repositories
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class TransactionRepositoryTest extends TestCase
{
    /**
     * Test error trying to update a transaction (processed)
     * passing an invalid identifier.
     */
    public function testErrorSetTransactionAsProcessedTransactionNotFound()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Transaction not found.');

        $transactionId = 23123222;

        $countryModelMock = \Mockery::mock(Country::class);
        $currencyModelMock = \Mockery::mock(Currency::class);
        $transactionModelMock = \Mockery::mock(Transaction::class);
        $transactionModelMock->expects('find')
            ->once()
            ->with($transactionId)
            ->andReturnNull();

        $transactionModelMock->expects('save')
            ->never();

        $transactionRepository = new TransactionRepository(
            $transactionModelMock,
            $countryModelMock,
            $currencyModelMock
        );

        $transactionRepository->setTransactionAsProcessed($transactionId);
    }

    /**
     * Test success setting transaction as processed.
     *
     * @throws \Exception
     */
    public function testSuccessSetTransactionAsProcessed()
    {
        $transactionId = 23135222;

        $countryModelMock = \Mockery::mock(Country::class);
        $currencyModelMock = \Mockery::mock(Currency::class);
        $transactionModelMock = \Mockery::mock(Transaction::class);
        $transactionModelMock->expects('find')
            ->once()
            ->with($transactionId)
            ->andReturnSelf();

        $transactionModelMock->expects('setAttribute')
            ->once()
            ->with('is_processed', true)
            ->andReturnSelf();

        $transactionModelMock->expects('save')
            ->once()
            ->withNoArgs()
            ->andReturnSelf();

        $transactionRepository = new TransactionRepository(
            $transactionModelMock,
            $countryModelMock,
            $currencyModelMock
        );

        $transactionRepository->setTransactionAsProcessed($transactionId);
    }
}
