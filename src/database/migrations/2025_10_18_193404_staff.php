<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('staff_id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('role');
            $table->boolean('active');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); //
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
