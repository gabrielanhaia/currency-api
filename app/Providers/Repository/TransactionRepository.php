<?php

namespace App\Providers\Repository;

use App\Models\Transaction;
use Illuminate\Support\ServiceProvider;

/**
 * Class TransactionRepository
 * @package App\Providers\Repository
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class TransactionRepository extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\TransactionRepository::class, function ($app) {
            return new \App\Repositories\TransactionRepository(new Transaction);
        });
    }
}
