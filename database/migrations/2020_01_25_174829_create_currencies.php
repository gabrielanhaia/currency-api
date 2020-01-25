<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateCurrencies responsible for creating the table that stores the currencies available.
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class CreateCurrencies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 400)->nullable(false);
            $table->string('initial', 5)->nullable(false)->index('index_currency_initial');
            $table->timestamps();
            $table->softDeletes()->index('index_currency_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
