<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('product_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('title');
            $table->text('description')->nullable();            
            $table->string('image');
            $table->integer('sort')->default(0);
            $table->tinyInteger('status')->default(1)->comment('0-InActive,1-Active');
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
        Schema::dropIfExists('banners');
    }
}
