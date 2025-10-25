<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_allergens', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('allergen_id');
            $table->primary(['product_id', 'allergen_id']);
            $table->foreign('product_id')->references('product_id')->on('product')->onDelete('cascade');
            $table->foreign('allergen_id')->references('allergen_id')->on('allergens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
