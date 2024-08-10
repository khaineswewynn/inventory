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
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_order_id');
            $table->unsignedBigInteger('product_id');            
            $table->integer('qty');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
        Schema::table('purchase_details',function(Blueprint $table){
            $table->foreign('product_id')->on('products')->references('id')->onDelete('cascade');
            $table->foreign('purchase_order_id')->on('purchase_orders')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_details');
    }
};
