<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('order_number', 10)->unique();
            $table->enum('order_status', ['pending', 'processing', 'delivered', 'cancelled'])->default('pending');
            $table->string('payment_method');
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->dateTime('order_date');
            $table->dateTime('delivered_date')->nullable();
            $table->dateTime('cancelled_date')->nullable();
            $table->string('logistics_type')->nullable();
            $table->text('tracking_code')->nullable();
            $table->float('sub_total')->default(0);
            $table->float('total_amount')->default(0);
            $table->float('coupon')->default(0)->nullable();
            $table->float('delivery_charge')->default(0)->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->integer('postcode')->nullable();
            $table->mediumText('note')->nullable(); 
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
        Schema::dropIfExists('orders');
    }
}
