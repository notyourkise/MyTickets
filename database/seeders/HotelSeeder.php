<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotels = [
            [
                'hotel_name' => 'Grand Hyatt Jakarta',
                'city' => 'Jakarta',
                'address' => 'Jl. MH Thamrin No.28-30, Jakarta Pusat',
                'star_rating' => 5,
                'description' => 'Hotel mewah di pusat Jakarta dengan fasilitas lengkap dan pelayanan world-class.',
                'facilities' => ['WiFi', 'Pool', 'Gym', 'Spa', 'Restaurant', 'Bar', 'Meeting Room', 'Parking'],
                'rating' => 4.7,
                'total_reviews' => 2150,
            ],
            [
                'hotel_name' => 'The Trans Resort Bali',
                'city' => 'Bali',
                'address' => 'Jl. Sunset Road No.105, Kuta, Bali',
                'star_rating' => 5,
                'description' => 'Resort mewah dengan pemandangan pantai yang menakjubkan dan fasilitas premium.',
                'facilities' => ['WiFi', 'Beach Access', 'Pool', 'Spa', 'Restaurant', 'Bar', 'Kids Club'],
                'rating' => 4.8,
                'total_reviews' => 1876,
            ],
            [
                'hotel_name' => 'Hotel Majapahit Surabaya',
                'city' => 'Surabaya',
                'address' => 'Jl. Tunjungan No.65, Surabaya',
                'star_rating' => 5,
                'description' => 'Hotel bersejarah dengan arsitektur kolonial yang elegan dan fasilitas modern.',
                'facilities' => ['WiFi', 'Pool', 'Gym', 'Spa', 'Restaurant', 'Meeting Room', 'Parking'],
                'rating' => 4.5,
                'total_reviews' => 1234,
            ],
            [
                'hotel_name' => 'Phoenix Hotel Yogyakarta',
                'city' => 'Yogyakarta',
                'address' => 'Jl. Jend. Sudirman No.9, Yogyakarta',
                'star_rating' => 4,
                'description' => 'Hotel heritage di jantung kota Yogyakarta dengan akses mudah ke Malioboro.',
                'facilities' => ['WiFi', 'Pool', 'Restaurant', 'Meeting Room', 'Parking'],
                'rating' => 4.3,
                'total_reviews' => 987,
            ],
        ];

        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
}
