<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateCountries responsible for creating the table that stores the countries available.
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class CreateCountries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 500)->nullable(false);
            $table->string('initial', 4)->nullable(false)->index('index_country_initial');
            $table->timestamps();
            $table->softDeletes()->index('index_country_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
