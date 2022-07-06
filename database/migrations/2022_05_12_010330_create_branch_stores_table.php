<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_stores', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('id_branch');
            $table->bigInteger('id_user');
            $table->string('name_branch');
            $table->string('address_branch');
            $table->int('phone_branch');
            $table->date('business_day');
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
        Schema::dropIfExists('branch_stores');
    }
}
