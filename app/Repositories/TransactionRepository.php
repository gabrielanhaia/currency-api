<?php


namespace App\Repositories;

use App\Models\Transaction;

/**
 * Class TransactionRepository
 * @package App\Repositories
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class TransactionRepository extends AbstractRepository
{
    /**
     * Method responsible for storing a new transaction.
     *
     * @param array $transactionData Data to be stored.
     * @return Transaction
     */
    public function storeTransaction(array $transactionData): Transaction
    {

    }

    /**
     * Method responsible for setting a transaction as processed.
     */
    public function setTransactionAsProcessed()
    {

    }
}
