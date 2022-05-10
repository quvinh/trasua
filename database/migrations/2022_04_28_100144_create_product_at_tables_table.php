<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAtTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_at_tables', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();
            $table->bigInteger('id_product');
            $table->bigInteger('id_table');
            $table->bigInteger('id_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_at_tables');
    }
}
