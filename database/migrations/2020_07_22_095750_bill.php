<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill', function (Blueprint $table) {
            $table->increments('bill_id');
            $table->integer('product_id');
            $table->boolean('bill_is_discount_percent')->nullable();
            $table->boolean('bill_is_signed')->nullable();
            $table->boolean('bill_is_VAT')->nullable();
            $table->integer('shop_id');
            $table->integer('bill_table_number')->nullable();
            $table->float('bill_total')->nullable();
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
        Schema::dropIfExists('bill');
    }
}
