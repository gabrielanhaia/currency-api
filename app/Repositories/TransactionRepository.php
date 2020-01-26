<?php


namespace App\Repositories;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class TransactionRepository
 * @package App\Repositories
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class TransactionRepository extends AbstractRepository
{
    /** @var Currency $currencyModel Model of currencies. */
    protected $currencyModel;

    /** @var Country $countryModel Model of countries. */
    protected $countryModel;

    /**
     * TransactionRepository constructor.
     * @param Transaction $model
     * @param Country $countryModel
     * @param Currency $currencyModel
     */
    public function __construct(Transaction $model, Country $countryModel, Currency $currencyModel)
    {
        parent::__construct($model);
        $this->countryModel = $countryModel;
        $this->currencyModel = $currencyModel;
    }

    /**
     * Method responsible for storing a new transaction.
     *
     * @param array $transactionData Data to be stored.
     * @return Transaction
     * @throws \Exception
     *
     * TODO: Create custom exceptions for the API.
     */
    public function storeTransaction(array $transactionData): Transaction
    {
        DB::beginTransaction();

        $currencyFrom = $this->currencyModel
            ->where('initial', '=', $transactionData['currency_from'])
            ->first();

        if (empty($currencyFrom)) {
            throw new \Exception('CurrencyFrom invalid.');
        }

        $currencyTo = $this->currencyModel
            ->where('initial', '=', $transactionData['currency_to'])
            ->first();

        if (empty($currencyTo)) {
            throw new \Exception('CurrencyTo invalid.');
        }

        $countryOrigin = $this->countryModel
            ->where('initial', '=', $transactionData['country_origin'])
            ->first();

        if (empty($countryOrigin)) {
            throw new \Exception('Country Origin invalid.');
        }

        $transactionDateTimeString = strtoupper($transactionData['datetime_transaction']);
        $transactionDateTime = \DateTime::createFromFormat('d-M-y H:i:s', $transactionDateTimeString);

        $transactionExists = $this->model
            ->where('user_id', '=', $transactionData['user_id'])
            ->where('currency_id_from', '=', $currencyFrom->id)
            ->where('currency_id_to', '=', $currencyTo->id)
            ->where('amount_sell', '=', $transactionData['amount_sell'])
            ->where('amount_buy', '=', $transactionData['amount_buy'])
            ->where('country_id', '=', $countryOrigin->id)
            ->where('rate', '=', $transactionData['rate'])
            ->whereDate('datetime_transaction', $transactionDateTime)
            ->first();

        if (!empty($transactionExists)) {
            throw new \Exception('Transaction had already been created.');
        }

        $transaction = $this->model::create([
            'user_id' => $transactionData['user_id'],
            'currency_id_from' => $currencyFrom->id,
            'currency_id_to' => $currencyTo->id,
            'amount_sell' => $transactionData['amount_sell'],
            'amount_buy' => $transactionData['amount_buy'],
            'rate' => $transactionData['rate'],
            'datetime_transaction' => $transactionDateTime,
            'country_id' => $countryOrigin->id,
            'created_at' => new \DateTime,
            'is_processed' => false
        ]);

        DB::commit();

        return $transaction;
    }

    /**
     * Method responsible for setting a transaction as processed.
     *
     * @param int $transactionId Transaction identifier to updated.
     * @throws \Exception
     */
    public function setTransactionAsProcessed(int $transactionId)
    {
        $transaction = $this->model->find($transactionId);

        if (empty($transaction)) {
            throw new \Exception('Transaction not found.');
        }

        $transaction->is_processed = true;
        $transaction->save();
    }
}
