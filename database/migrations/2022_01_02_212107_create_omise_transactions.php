<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOmiseTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('omise_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('order_number', 10)->unique();
            $table->float('amount')->default(0);
            $table->date('transaction_date');
            $table->text('transaction_ref')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('last_digits')->nullable();
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('omise_transactions');
    }
}
