<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('guest', function (Blueprint $table) {
            $table->increments('guest_id');
            $table->integer('guest_session_id')->unsigned();
            $table->dateTime('created_at');
            //$table->string('allergen_filter')->nullable();
            $table->foreign('guest_session_id')->references('session_id')->on('guest_session')->onDelete('cascade'); //

            
        });

    }


    public function down(): void
    {
        Schema::dropIfExists('guest');
    }
};
