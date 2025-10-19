<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('order_item', function (Blueprint $table) {
            $table->increments('order_item_id');
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('quantity');
            $table->decimal('unit_price', 8, 2);
            $table->string('comment')->nullable();
            $table->foreign('order_id')->references('order_id')->on('order')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('product')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_item');
    }
};
