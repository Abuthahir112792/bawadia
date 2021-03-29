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
            $table->bigIncrements('id');
            $table->integer('invoice_no');
            $table->string('invoice_prefix');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('shipping_address_id')->default(0);
            $table->string('customer_name');
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('contact');
            $table->string('email')->nullable();
            $table->double('lat')->nullable(); 
            $table->double('lon')->nullable();
            $table->double('total');
            $table->unsignedBigInteger('order_status_id');
            $table->date('pickup_date')->nullable();
            $table->time('pickup_time')->nullable();
            $table->string('car_number')->nullable();
            $table->string('car_name')->nullable();
            $table->unsignedBigInteger('delivery_agent')->default(0);
            $table->string('type')->default('Delivery');
            $table->integer('ip')->nullable();          
            $table->text('note')->nullable();
            $table->double('discount')->nullable()->default(0);           
            $table->unsignedBigInteger('coupon_id')->nullable()->default(0);           
            $table->tinyInteger('status')->default(1)->comment('0-InActive,1-Active,2-Deleted');
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
