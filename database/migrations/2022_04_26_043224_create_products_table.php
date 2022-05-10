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
            // $table->id();
            $table->bigIncrements('id_product');
            $table->bigInteger('id_category');
            $table->bigInteger('id_size');
            $table->string('name');
            $table->string('unit');
            $table->float('price');
            $table->integer('amount');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->float('promotional_price')->nullable();
            $table->boolean('visible')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
