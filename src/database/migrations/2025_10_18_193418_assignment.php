<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('assignment', function (Blueprint $table) {
            $table->increments('assignment_id');
            $table->integer('table_number')->unsigned();
            $table->unsignedBigInteger('id');
            $table->dateTime('assigned_at');
            $table->string('status');
            $table->foreign('table_number')->references('table_number')->on('table_location')->onDelete('cascade');
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });

    }


    public function down(): void
    {
        Schema::dropIfExists('assignment');
    }
};
