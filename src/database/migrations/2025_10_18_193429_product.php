<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('name');
            $table->string('category');
            $table->decimal('price', 8, 2);
            $table->string('status');
            $table->string('photo_url')->nullable();
            $table->boolean('is_featured')->default(false);
            //$table->string('allergen_tags')->nullable();
            //$table->string('area')->nullable();
            //$table->integer('stock_qty');
            $table->unsignedInteger('area_id')->nullable()->after('category');
            $table->foreign('area_id')->references('area_id')->on('areas')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
