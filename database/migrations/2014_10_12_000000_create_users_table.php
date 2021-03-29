<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->nullable()->default('/profile.png');
            $table->text('address')->nullable();
            $table->string('contact')->nullable();
            $table->double('lat')->nullable();
            $table->double('lon')->nullable();
            $table->integer('type')->default(4);
            $table->string('language')->default('en');
            $table->unsignedBigInteger('shipping_address_id')->nullable()->default(0);            
            $table->unsignedBigInteger('branch_id')->nullable();            
            $table->tinyInteger('status')->default(2);
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
