<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bus;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buses = [
            [
                'bus_company' => 'Pohon Kelor',
                'bus_type' => 'Executive AC',
                'origin_terminal' => 'Terminal Kampung Rambutan (Jakarta)',
                'destination_terminal' => 'Terminal Bungurasih (Surabaya)',
                'departure_time' => '20:00',
                'arrival_time' => '08:00',
                'duration_minutes' => 720,
                'price' => 220000,
                'total_seats' => 45,
                'available_seats' => 35,
                'facilities' => ['AC', 'WiFi', 'Toilet', 'Reclining Seat', 'Snack'],
                'days_of_week' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
            ],
            [
                'bus_company' => 'Rosalia Indah',
                'bus_type' => 'VIP AC',
                'origin_terminal' => 'Terminal Giwangan (Yogyakarta)',
                'destination_terminal' => 'Terminal Kampung Rambutan (Jakarta)',
                'departure_time' => '19:30',
                'arrival_time' => '05:30',
                'duration_minutes' => 600,
                'price' => 180000,
                'total_seats' => 40,
                'available_seats' => 28,
                'facilities' => ['AC', 'Reclining Seat', 'Blanket', 'Snack'],
                'days_of_week' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
            ],
            [
                'bus_company' => 'Harapan Jaya',
                'bus_type' => 'Super Executive',
                'origin_terminal' => 'Terminal Arjosari (Malang)',
                'destination_terminal' => 'Terminal Purabaya (Surabaya)',
                'departure_time' => '14:00',
                'arrival_time' => '17:30',
                'duration_minutes' => 210,
                'price' => 85000,
                'total_seats' => 35,
                'available_seats' => 25,
                'facilities' => ['AC', 'WiFi', 'USB Charger'],
                'days_of_week' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'],
            ],
        ];

        foreach ($buses as $bus) {
            Bus::create($bus);
        }
    }
}
