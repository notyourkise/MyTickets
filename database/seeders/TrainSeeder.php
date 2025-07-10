<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Train;

class TrainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trains = [
            [
                'train_name' => 'Argo Bromo Anggrek',
                'train_number' => 'ABA-01',
                'origin_station' => 'Gambir (Jakarta)',
                'destination_station' => 'Pasar Senen (Surabaya)',
                'departure_time' => '20:00',
                'arrival_time' => '05:30',
                'duration_minutes' => 570,
                'price_economy' => 350000,
                'price_business' => 550000,
                'price_executive' => 750000,
                'seats_economy' => 200,
                'seats_business' => 50,
                'seats_executive' => 30,
                'available_economy' => 180,
                'available_business' => 40,
                'available_executive' => 25,
                'days_of_week' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
            ],
            [
                'train_name' => 'Taksaka',
                'train_number' => 'TSK-02',
                'origin_station' => 'Gambir (Jakarta)',
                'destination_station' => 'Tugu (Yogyakarta)',
                'departure_time' => '07:00',
                'arrival_time' => '15:30',
                'duration_minutes' => 510,
                'price_economy' => 300000,
                'price_business' => 450000,
                'price_executive' => 650000,
                'seats_economy' => 180,
                'seats_business' => 40,
                'seats_executive' => 25,
                'available_economy' => 160,
                'available_business' => 35,
                'available_executive' => 20,
                'days_of_week' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
            ],
            [
                'train_name' => 'Bima',
                'train_number' => 'BIM-03',
                'origin_station' => 'Pasar Senen (Jakarta)',
                'destination_station' => 'Kota Malang',
                'departure_time' => '18:00',
                'arrival_time' => '06:15',
                'duration_minutes' => 735,
                'price_economy' => 280000,
                'price_business' => 420000,
                'seats_economy' => 200,
                'seats_business' => 45,
                'available_economy' => 175,
                'available_business' => 38,
                'days_of_week' => ['monday', 'wednesday', 'friday', 'sunday'],
            ],
        ];

        foreach ($trains as $train) {
            Train::create($train);
        }
    }
}
