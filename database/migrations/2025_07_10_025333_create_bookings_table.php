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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('booking_type'); // flight, train, bus, hotel
            $table->unsignedBigInteger('bookable_id'); // ID dari flight/train/bus/hotel
            $table->string('bookable_type'); // App\Models\Flight, App\Models\Train, etc
            $table->json('passenger_details'); // Detail penumpang
            $table->date('travel_date');
            $table->date('return_date')->nullable();
            $table->string('class_type')->nullable(); // economy, business, executive
            $table->integer('quantity')->default(1);
            $table->decimal('total_price', 12, 2);
            $table->string('payment_status')->default('pending'); // pending, paid, cancelled
            $table->string('booking_status')->default('confirmed'); // confirmed, cancelled
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
            
            $table->index(['bookable_id', 'bookable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
