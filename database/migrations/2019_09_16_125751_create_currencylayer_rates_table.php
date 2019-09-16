<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrencylayerRatesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('currencylayer_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('source_currency_id')->index();
            $table->foreign('source_currency_id')->references('id')->on('currencylayer_currencies')->onDelete('cascade');
            $table->unsignedBigInteger('target_currency_id')->index();
            $table->foreign('target_currency_id')->references('id')->on('currencylayer_currencies')->onDelete('cascade');
            $table->decimal('rate', 20, 14);
            $table->timestamp('timestamp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('currencylayer_rates');
    }
}
