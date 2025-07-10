<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Flight;
use Carbon\Carbon;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $flights = [
            [
                'airline' => 'Garuda Indonesia',
                'flight_number' => 'GA-101',
                'origin_city' => 'Jakarta',
                'origin_airport' => 'CGK',
                'destination_city' => 'Bali',
                'destination_airport' => 'DPS',
                'departure_time' => Carbon::create(2025, 7, 15, 8, 0),
                'arrival_time' => Carbon::create(2025, 7, 15, 10, 30),
                'duration_minutes' => 150,
                'aircraft_type' => 'Boeing 737',
                'price_economy' => 1200000,
                'price_business' => 2500000,
                'price_first' => 4000000,
                'seats_economy' => 150,
                'seats_business' => 20,
                'seats_first' => 8,
                'available_economy' => 120,
                'available_business' => 15,
                'available_first' => 5,
            ],
            [
                'airline' => 'Lion Air',
                'flight_number' => 'JT-201',
                'origin_city' => 'Jakarta',
                'origin_airport' => 'CGK',
                'destination_city' => 'Surabaya',
                'destination_airport' => 'MLG',
                'departure_time' => Carbon::create(2025, 7, 15, 14, 30),
                'arrival_time' => Carbon::create(2025, 7, 15, 16, 45),
                'duration_minutes' => 135,
                'aircraft_type' => 'Airbus A320',
                'price_economy' => 800000,
                'price_business' => 1500000,
                'seats_economy' => 180,
                'seats_business' => 12,
                'available_economy' => 160,
                'available_business' => 10,
            ],
            [
                'airline' => 'Citilink',
                'flight_number' => 'QG-301',
                'origin_city' => 'Bali',
                'origin_airport' => 'DPS',
                'destination_city' => 'Yogyakarta',
                'destination_airport' => 'JOG',
                'departure_time' => Carbon::create(2025, 7, 15, 11, 15),
                'arrival_time' => Carbon::create(2025, 7, 15, 13, 0),
                'duration_minutes' => 105,
                'aircraft_type' => 'Airbus A320',
                'price_economy' => 950000,
                'seats_economy' => 180,
                'available_economy' => 150,
            ],
        ];

        foreach ($flights as $flight) {
            Flight::create($flight);
        }
    }
}
