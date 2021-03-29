<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('model')->nullable();
            $table->string('size_type')->nullable()->default('single');
            $table->string('price')->nullable();
            $table->string('points')->nullable();
            $table->string('video_link')->nullable();
            $table->string('dimensions_l')->nullable(); 
            $table->string('dimensions_w')->nullable();
            $table->string('dimensions_h')->nullable();
            $table->string('dimensions_class')->nullable();
            $table->string('weight')->nullable();
            $table->string('weight_class')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('slug')->unique();
            $table->tinyInteger('veg')->default(0);
            $table->tinyInteger('sort')->default(1);
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
        Schema::dropIfExists('products');
    }
}
