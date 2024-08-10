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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no');
            $table->date('purchaseorder_date');
            $table->unsignedBigInteger('provider_id');
            $table->decimal('total',8,2);
            $table->timestamps();
        });
        Schema::table('purchase_orders',function(Blueprint $table){
            $table->foreign('provider_id')->on('provider')->references('id')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_orders');
    }
};
