<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('from_currency_id');
            $table->integer('to_currency_id');
            $table->double('currency_rate');
            $table->double('currency_surcharge_percentage');
            $table->double('amount_of_currency_surcharge');
            $table->double('amount_of_currency_purchased');
            $table->double('amount_paid');
            $table->double('discount_percentage');
            $table->double('discount_amount');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
