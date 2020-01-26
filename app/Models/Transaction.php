<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Transaction
 * @package App\Models
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class Transaction extends Model
{
    use SoftDeletes;

    /** @var string $table Table name. */
    protected $table = 'transactions';

    /** @var array $fillable Fillable fields. */
    protected $fillable = [
        'user_id',
        'currency_id_from',
        'currency_id_to',
        'amount_sell',
        'amount_buy',
        'rate',
        'datetime_transaction',
        'country_id',
        'is_processed',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /** @var array $dates Fields that are dates. */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'datetime_transaction'
    ];

    /**
     * Return the currency-to related to the transaction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function currencyFrom()
    {
        return $this->hasOne(Currency::class, 'id', 'currency_id_from');
    }

    /**
     * Return the currency-to related to the transaction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function currencyTo()
    {
        return $this->hasOne(Currency::class, 'id', 'currency_id_to');
    }

    /**
     * Return the country origin from the transaction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function countryOrigin()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }
}
