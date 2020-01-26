<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ProcessTransactionRequest;
use App\Http\Resources\Api\V1\TransactionResource;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use App\Service\Processor\TransactionProcessor;
use Illuminate\Http\Request;

/**
 * Class TransactionController
 * @package App\Http\Controllers\Api\V1
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class TransactionController extends Controller
{
    /**
     * Method responsible for store and process a transaction.
     *
     * @param ProcessTransactionRequest $request
     * @param TransactionRepository $repository
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function processTransaction(ProcessTransactionRequest $request, TransactionRepository $repository)
    {
        $transactionData = [
            'user_id' => $request->post('userId'),
            'currency_from' => $request->post('currencyFrom'),
            'currency_to' => $request->post('currencyTo'),
            'amount_sell' => $request->post('amountSell'),
            'amount_buy' => $request->post('amountBuy'),
            'rate' => $request->post('rate'),
            'datetime_transaction' => $request->post('timePlaced'),
            'country_origin' => $request->post('originatingCountry')
        ];

        $transaction = $repository->storeTransaction($transactionData);

        $transactionProcessor = new TransactionProcessor;
        $transactionProcessor->processTransaction($transaction);

        return (new TransactionResource($transaction))
            ->response()
            ->setStatusCode(202);
    }
}
