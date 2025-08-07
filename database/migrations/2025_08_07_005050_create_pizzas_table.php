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
        Schema::create('pizzas', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('image')->nullable(); // Store image path/URL
            $table->text('description'); 
            $table->decimal('price_small', 8, 2);
            $table->decimal('price_medium', 8, 2);
            $table->decimal('price_large', 8, 2);
            $table->decimal('price_x_large', 8, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pizzas');
    }
};
