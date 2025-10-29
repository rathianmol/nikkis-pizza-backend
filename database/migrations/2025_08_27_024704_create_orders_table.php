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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Order belongs to a User.
            $table->json('cart_items'); // Stores the cartþ tems array as json
            $table->integer('amount'); // Total number of items
            $table->decimal('total_price', 8, 2); // Total price with 2 decimal places
            $table->enum('order_type', ['pickup', 'delivery'])->default('pickup');
            $table->enum('payment_method', ['cash', 'card'])->default('cash'); // Nullable for cash orders.
            $table->json('delivery_address')->nullable(); // Stores address object, nullable for pickup orders.
            $table->json('card_info')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'preparing', 'ready', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
