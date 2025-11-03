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
        Schema::create('menu_addon_prices', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('addon_id')->constrained('menu_item_addons')->onDelete('cascade');
            $table->enum('size', ['default', 'regular', 'medium', 'large']);
            $table->decimal('price', 8, 2);

            $table->timestamps();

            // Ensure unique size per addon
            $table->unique(['addon_id', 'size']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_addon_prices');
    }
};
