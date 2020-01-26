<?php

namespace App\Providers;

use CurrencyFair\IntegrationIrishBank\Integration\{
    Client,
    Factory\Formatter\FormatterSimpleFactory,
    Factory\Parser\ParserSimpleFactory,
    Factory\Requester\RequesterSimpleFactory
};
use Illuminate\Support\ServiceProvider;

/**
 * Class IntegrationBrazilianBankServiceProvider
 * @package App\Providers
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class IntegrationBrazilianBankServiceProvider extends ServiceProvider
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
