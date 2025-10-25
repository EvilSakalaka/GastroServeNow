<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('review', function (Blueprint $table) {
            $table->increments('review_id');
            $table->integer('guest_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->integer('rating');
            $table->string('comment')->nullable();
            $table->dateTime('created_at');
            $table->foreign('guest_id')->references('guest_id')->on('guest')->onDelete('cascade');
            $table->foreign('order_id')->references('order_id')->on('order')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};
