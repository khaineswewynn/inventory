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
        Schema::create('sales_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('sales_id');
            $table->decimal('price', 8, 2);
            $table->integer('qty');
            $table->decimal('total', 8, 2); 
            $table->timestamps();
        });
        Schema::table('sales_details',function(Blueprint $table){
            $table->foreign('product_id')->on('products')->references('id')->onDelete('cascade');
            $table->foreign('sales_id')->on('sales')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_details');
    }
};
