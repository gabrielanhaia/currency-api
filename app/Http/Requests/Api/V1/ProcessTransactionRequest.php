<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProcessTransactionRequest Responsible for validating the creation of transactions.
 * @package App\Http\Requests\Api\V1
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class ProcessTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'userId' => 'required|numeric',
            'currencyFrom' => 'required|string',
            'currencyTo' => 'required|string',
            'amountSell' => 'required|numeric',
            'amountBuy' => 'required|numeric',
            'originatingCountry' => 'required|string'
        ];
    }
}
