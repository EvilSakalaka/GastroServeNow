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
        Schema::create('guest_allergens', function (Blueprint $table) {
            $table->unsignedInteger('guest_id');
            $table->unsignedInteger('allergen_id');
            $table->primary(['guest_id', 'allergen_id']);
            $table->foreign('guest_id')->references('guest_id')->on('guest')->onDelete('cascade');
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
