<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_orders', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();
            $table->bigInteger('id_product');
            $table->bigInteger('id_order');
            $table->bigInteger('id_customer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('online_orders');
    }
}
