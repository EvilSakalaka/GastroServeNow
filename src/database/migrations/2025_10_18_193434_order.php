<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('order_id');
            $table->integer('guest_session_id')->unsigned();
            $table->string('status');
            $table->dateTime('timestamp_ordered');
            $table->dateTime('timestamp_closed')->nullable();
            $table->string('payment_method')->nullable();
            $table->integer('tip_percent')->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->foreign('guest_session_id')->references('session_id')->on('guest_session')->onDelete('cascade');
            $table->integer('table_number')->unsigned();
            $table->foreign('table_number')->references('table_number')->on('table_location')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
