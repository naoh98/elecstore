<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('product_id');
            $table->string('product_title');
            $table->longText('product_desc');
            $table->text('product_main_image');
            $table->longText('product_images');
            $table->integer('product_manufacturer');
            $table->integer('product_quantity');
            $table->integer('product_type');
            $table->double('product_price_core');
            $table->integer('product_tax');
            $table->double('product_price_sell');
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
        Schema::dropIfExists('product');
    }
}
