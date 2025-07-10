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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('airline');
            $table->string('flight_number');
            $table->string('origin_city');
            $table->string('origin_airport');
            $table->string('destination_city');
            $table->string('destination_airport');
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->integer('duration_minutes');
            $table->string('aircraft_type')->nullable();
            $table->decimal('price_economy', 10, 2);
            $table->decimal('price_business', 10, 2)->nullable();
            $table->decimal('price_first', 10, 2)->nullable();
            $table->integer('seats_economy');
            $table->integer('seats_business')->default(0);
            $table->integer('seats_first')->default(0);
            $table->integer('available_economy');
            $table->integer('available_business')->default(0);
            $table->integer('available_first')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
