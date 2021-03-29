<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('currency');
            $table->string('language')->default('en');
            $table->tinyInteger('language_status')->default(0)->comment('0-All,1-English,2-Arabic');
            $table->string('language_admin')->default('en');
            $table->tinyInteger('branch_status')->default(0)->comment('0-Single Branch,1-Multi Branch');
            $table->tinyInteger('order_status')->default(1)->comment('0-InActive,1-Active');
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
        Schema::dropIfExists('settings');
    }
}
