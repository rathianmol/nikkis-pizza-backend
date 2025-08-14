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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone', 20)->unique()->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};


/**
 * 
 * Order Table:
 * 
 * 1. pizza_type: {regular_cheese, paneer_tikka_masala, tandoori_veggie_delight}
 *      // An enum, only one.
 * 2. pizza_quantity
 * 3. pizza_size: {S, M, L, XL}
 * 4. crust_type: thin, regualar, ...}
 * 5. crust_seasoning: {none, garlic_crust}
 * 6. cheese_amount: {light, normal, extra}
 * 7. toppings: {jalapenos, onions, banana peppers, diced tomatoes, black olives, mushrooms, green peppers, spinach}
 * 8. dipping_sauces: {
 *               {
 *                  name: ranch,
 *                  quantity: 0   
 *               },
 *               {
 *                  name: garlic,
 *                  quantity: 0   
 *               }
 *            }
 * 9. salads: {
 *               {
 *                  name: classic garden,
 *                  quantity: 0   
 *               },
 *               {
 *                  name: some other name,
 *                  quantity: 0   
 *               }
 *            }
 * 10. customer_id // "order belongsTo customer"
 * 11. relevant time_stamps
 *  
 * 
 */