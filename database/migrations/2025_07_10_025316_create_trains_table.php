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
        Schema::create('trains', function (Blueprint $table) {
            $table->id();
            $table->string('train_name');
            $table->string('train_number');
            $table->string('origin_station');
            $table->string('destination_station');
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->integer('duration_minutes');
            $table->decimal('price_economy', 10, 2);
            $table->decimal('price_business', 10, 2)->nullable();
            $table->decimal('price_executive', 10, 2)->nullable();
            $table->integer('seats_economy');
            $table->integer('seats_business')->default(0);
            $table->integer('seats_executive')->default(0);
            $table->integer('available_economy');
            $table->integer('available_business')->default(0);
            $table->integer('available_executive')->default(0);
            $table->json('days_of_week'); // ['monday', 'tuesday', etc]
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trains');
    }
};
