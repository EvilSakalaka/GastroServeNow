<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('guest_session', function (Blueprint $table) {
            $table->increments('session_id');
            $table->integer('table_number')->unsigned();
            $table->string('session_token');
            $table->dateTime('started_at');
            $table->dateTime('ended_at')->nullable();
            $table->boolean('active');
            $table->foreign('table_number')->references('table_number')->on('table_location')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('guest_session');
    }
};
