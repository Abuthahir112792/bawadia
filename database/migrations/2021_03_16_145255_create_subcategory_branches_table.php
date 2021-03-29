<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcategoryBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategory_branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('subcategory_id');
            $table->integer('branch_id');
            $table->tinyInteger('sort')->default(1);
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
        Schema::dropIfExists('subcategory_branches');
    }
}
