<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class AddFieldIsProcessedTransactions
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class AddFieldIsProcessedTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->boolean('is_processed')->after('country_id')
                ->default(false)
                ->comment('This field defines is a transaction had already been processed.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('is_processed');
        });
    }
}
