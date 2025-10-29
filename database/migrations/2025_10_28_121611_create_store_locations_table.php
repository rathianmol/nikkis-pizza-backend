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
        Schema::create('store_locations', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->string('country')->default('USA');
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();

            $table->string('monday_hours')->nullable();
            $table->string('tuesday_hours')->nullable();
            $table->string('wednesday_hours')->nullable();
            $table->string('thursday_hours')->nullable();
            $table->string('friday_hours')->nullable();
            $table->string('saturday_hours')->nullable();
            $table->string('sunday_hours')->nullable();

            $table->boolean('is_active')->default(false);
            $table->boolean('is_primary')->default(false);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_locations');
    }
};
