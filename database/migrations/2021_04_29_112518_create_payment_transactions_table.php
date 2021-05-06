<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('lrn',13);
            $table->string('scheme_name',150);
            $table->string('payment',15);

            $table->integer('full_amount');
            $table->integer('amount');
            $table->integer('remaining_balance');

            $table->string('receipt_number',50);
            $table->string('cashier',150);
            $table->string('status',10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_transactions');
    }
}
