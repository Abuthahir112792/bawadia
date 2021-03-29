<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSadadResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sadad_responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('website_ref_no');
            $table->string('transaction_status');
            $table->string('transaction_number');
            $table->string('MID');
            $table->string('RESPCODE');
            $table->string('RESPMSG');
            $table->string('ORDERID');
            $table->string('STATUS');
            $table->string('TXNAMOUNT');
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
        Schema::dropIfExists('sadad_responses');
    }
}
