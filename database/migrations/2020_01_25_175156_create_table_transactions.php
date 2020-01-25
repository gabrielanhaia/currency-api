<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            /** I didn't linked the user table with 'used_id' because I didn't
             * know the ids the currency fair will send to test it. **/
            $table->bigInteger('user_id')->nullable(false)->unsigned();
            $table->bigInteger('currency_id_from')->nullable(false)->unsigned();
            $table->bigInteger('currency_id_to')->nullable(false)->unsigned();
            $table->float('amount_sell')->nullable(false);
            $table->float('amount_buy')->nullable(false);
            $table->float('rate')->nullable(false);
            $table->dateTime('datetime_transaction')->nullable(false);
            $table->bigInteger('country_id')->nullable(false)->unsigned();
            $table->timestamps();
            $table->softDeletes()->index('index_transaction_deleted_at');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('currency_id_from', 'fk_transactions_currency_id_from')
                ->references('id')
                ->on('currencies');

            $table->foreign('currency_id_to', 'fk_transactions_currency_id_to')
                ->references('id')
                ->on('currencies');

            $table->foreign('country_id', 'fk_transactions_country_id')
                ->references('id')
                ->on('countries');

            $table->unique([
                'user_id',
                'currency_id_from',
                'currency_id_to',
                'amount_sell',
                'amount_buy',
                'rate',
                'datetime_transaction',
                'country_id'
            ], 'unique_transaction');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
