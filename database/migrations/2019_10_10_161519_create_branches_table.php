<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('address');
            $table->string('email')->nullable();
            $table->string('contact_1');
            $table->string('contact_2')->nullable();
            $table->time('sat_start');
            $table->time('sat_end');
            $table->time('sun_start');
            $table->time('sun_end');
            $table->time('mon_start');
            $table->time('mon_end');
            $table->time('tue_start');
            $table->time('tue_end');
            $table->time('wed_start');
            $table->time('wed_end');
            $table->time('thu_start');
            $table->time('thu_end');
            $table->time('fri_start');
            $table->time('fri_end');
            $table->integer('radious')->default(15);
            $table->boolean('is_discount')->default(false);
            $table->integer('percentage')->default(0);
            $table->integer('minimum_discount_amount')->default(20);
            $table->string('icon')->nullable();
            $table->string('invoice_prefix')->nullable();
            $table->string('pickup_time')->nullable();
            $table->string('preparetion_time')->nullable();
            $table->string('delivery_time')->nullable();
            $table->double('lat')->nullable(); 
            $table->double('lng')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0-InActive,1-Active,2-Deleted');
            $table->softDeletes();
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
        Schema::dropIfExists('branches');
    }
}
