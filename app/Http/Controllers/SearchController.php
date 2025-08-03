<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:pesawat,kereta,bus,hotel',
            'from' => 'required|string',
            'to' => 'required_unless:type,hotel|string',
            'date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:date',
            'passengers' => 'required|integer|min:1|max:4',
        ]);

        // Untuk sementara, kita akan mengembalikan view dengan data pencarian
        return view('search.results', [
            'type' => $validated['type'],
            'from' => $validated['from'],
            'to' => $validated['to'] ?? null,
            'date' => $validated['date'],
            'return_date' => $validated['return_date'] ?? null,
            'passengers' => $validated['passengers'],
            // Tambahkan dummy results sesuai dengan tipe pencarian
            'results' => $this->getDummyResults($validated['type'])
        ]);
    }

    private function getDummyResults($type)
    {
        $results = [];
        
        switch ($type) {
            case 'pesawat':
                $results = [
                    [
                        'provider' => 'Garuda Indonesia',
                        'departure' => '07:00',
                        'arrival' => '08:30',
                        'price' => 1500000,
                        'type' => 'Direct',
                        'logo' => 'garuda-logo.png'
                    ],
                    [
                        'provider' => 'Lion Air',
                        'departure' => '08:15',
                        'arrival' => '09:45',
                        'price' => 800000,
                        'type' => 'Direct',
                        'logo' => 'lion-logo.png'
                    ]
                ];
                break;
            
            case 'kereta':
                $results = [
                    [
                        'provider' => 'Argo Bromo Anggrek',
                        'departure' => '06:30',
                        'arrival' => '13:45',
                        'price' => 350000,
                        'class' => 'Eksekutif',
                        'logo' => 'kai-logo.png'
                    ],
                    [
                        'provider' => 'Gajayana',
                        'departure' => '08:00',
                        'arrival' => '15:15',
                        'price' => 280000,
                        'class' => 'Bisnis',
                        'logo' => 'kai-logo.png'
                    ]
                ];
                break;

            case 'bus':
                $results = [
                    [
                        'provider' => 'Rosalia Indah',
                        'departure' => '19:00',
                        'arrival' => '05:00',
                        'price' => 180000,
                        'class' => 'Executive',
                        'logo' => 'rosalia-logo.png'
                    ],
                    [
                        'provider' => 'Sinar Jaya',
                        'departure' => '20:00',
                        'arrival' => '06:00',
                        'price' => 160000,
                        'class' => 'VIP',
                        'logo' => 'sinarjaya-logo.png'
                    ]
                ];
                break;

            case 'hotel':
                $results = [
                    [
                        'name' => 'Grand Hyatt',
                        'rating' => 5,
                        'price' => 1200000,
                        'address' => 'Jl. MH Thamrin',
                        'facilities' => ['Pool', 'Spa', 'Gym'],
                        'image' => 'hyatt.jpg'
                    ],
                    [
                        'name' => 'Mercure',
                        'rating' => 4,
                        'price' => 800000,
                        'address' => 'Jl. Hayam Wuruk',
                        'facilities' => ['Pool', 'Restaurant'],
                        'image' => 'mercure.jpg'
                    ]
                ];
                break;
        }

        return $results;
    }
}
