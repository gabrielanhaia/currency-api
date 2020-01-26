<?php

namespace App\Providers;

use CurrencyFair\IntegrationBrazillianBank\Integration\{
    Client,
    Factory\Formatter\FormatterSimpleFactory,
    Factory\Parser\ParserSimpleFactory,
    Factory\Requester\RequesterSimpleFactory
};
use Illuminate\Support\ServiceProvider;

/**
 * Class IntegrationIrishBankServiceProvider
 * @package App\Providers
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class IntegrationIrishBankServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(Client::class, function ($app) {
            return new Client(
                new FormatterSimpleFactory,
                new ParserSimpleFactory,
                new RequesterSimpleFactory
            );
        });
    }
}
