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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Basic info
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            // Pricing
            $table->decimal('price', 10, 2);
            $table->decimal('initial_price', 10, 2)->nullable();

            // Stock
            $table->unsignedInteger('stock')->default(0);

            // Category relationships
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id');

            // Images (simple approach)
            $table->json('images')->nullable();

            // Status
            $table->enum('status', ['published', 'draft'])->default('draft');

            $table->timestamps();

            // Foreign keys
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
