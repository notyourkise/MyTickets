@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-2xl font-bold mb-6 text-sky-600">Hasil Pencarian Tiket Pesawat</h2>
    <div class="mb-4">
        <span class="font-semibold">Dari:</span> {{ $request->origin }}
        <span class="ml-4 font-semibold">Ke:</span> {{ $request->destination }}
        <span class="ml-4 font-semibold">Tanggal:</span> {{ $request->departure_date }}
        <span class="ml-4 font-semibold">Kelas:</span> {{ ucfirst($request->class) }}
        <span class="ml-4 font-semibold">Penumpang:</span> {{ $request->passengers }}
    </div>
    @if($flights->count())
        <div class="grid gap-6">
            @foreach($flights as $flight)
                <div class="bg-white rounded-lg shadow p-6 flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <div class="font-bold text-lg text-sky-700">{{ $flight->airline }} ({{ $flight->flight_number }})</div>
                        <div class="text-gray-600">{{ $flight->origin_city }} ({{ $flight->origin_airport }}) → {{ $flight->destination_city }} ({{ $flight->destination_airport }})</div>
                        <div class="text-gray-500 text-sm">{{ $flight->departure_time->format('d M Y H:i') }} - {{ $flight->arrival_time->format('H:i') }} ({{ $flight->duration_minutes }} menit)</div>
                    </div>
                    <div class="mt-4 md:mt-0 text-right">
                        <div class="text-xl font-bold text-sky-600">
                            @php
                                $price = $flight['price_' . $request->class];
                            @endphp
                            Rp {{ number_format($price, 0, ',', '.') }}
                        </div>
                        <a href="{{ route('flights.show', $flight->id) }}?class={{ $request->class }}&passengers={{ $request->passengers }}&departure_date={{ $request->departure_date }}" class="btn btn-primary mt-2">Lihat Detail</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded">Tidak ada tiket ditemukan untuk pencarian Anda.</div>
    @endif
    <div class="mt-6">
        <a href="{{ route('flights.index') }}" class="btn btn-outline">Kembali ke Pencarian</a>
    </div>
</div>
@endsection
