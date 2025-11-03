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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')->constrained('menu_categories')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->boolean('has_sizes')->default(false); // true for pizza, false for fries
            $table->boolean('has_addons')->default(false); // true for pizza, false for desserts
            $table->boolean('is_available')->default(true);
            $table->boolean('is_special')->default(false); // for chef special items
            $table->integer('display_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
