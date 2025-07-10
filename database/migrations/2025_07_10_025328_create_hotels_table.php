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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('hotel_name');
            $table->string('city');
            $table->string('address');
            $table->integer('star_rating'); // 1-5 stars
            $table->text('description')->nullable();
            $table->json('facilities')->nullable(); // ['WiFi', 'Pool', 'Gym', etc]
            $table->string('image_url')->nullable();
            $table->decimal('rating', 2, 1)->default(0); // 0.0 - 5.0
            $table->integer('total_reviews')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
