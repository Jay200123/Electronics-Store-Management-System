<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('orderinfo', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->date('date_placed');
            $table->date('date_shipped');
            $table->decimal('shipping');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('orderline', function(Blueprint $table) {
            $table->integer('orderinfo_id')->unsigned();
            $table->foreign('orderinfo_id')->references('id')->on('orderinfo');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderinfo');
        Schema::dropIfExists('orderline');
    }
};
