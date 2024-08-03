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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('number');
            // $table->unsignedBigInteger('sales_detail');
            $table->unsignedBigInteger('cus_id')->default(1);
            $table->string('email')->nullable();
            $table->string('phone');
            $table->timestamps();
        });
        Schema::table('sales',function(Blueprint $table){
            $table->foreign('cus_id')->on('customers')->references('id')->onDelete('cascade');
            // $table->foreign('sales_detail')->on('sales_details')->references('id')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
};
