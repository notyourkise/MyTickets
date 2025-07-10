@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-2xl font-bold mb-6 text-sky-600">Detail Tiket Pesawat</h2>
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="font-bold text-lg text-sky-700">{{ $flight->airline }} ({{ $flight->flight_number }})</div>
        <div class="text-gray-600 mb-2">{{ $flight->origin_city }} ({{ $flight->origin_airport }}) → {{ $flight->destination_city }} ({{ $flight->destination_airport }})</div>
        <div class="text-gray-500 text-sm mb-2">{{ $flight->departure_time->format('d M Y H:i') }} - {{ $flight->arrival_time->format('H:i') }} ({{ $flight->duration_minutes }} menit)</div>
        <div class="text-gray-500 text-sm mb-2">Tipe Pesawat: {{ $flight->aircraft_type ?? '-' }}</div>
        <div class="text-gray-500 text-sm mb-2">Kursi Tersedia: Ekonomi {{ $flight->available_economy }}, Bisnis {{ $flight->available_business }}, First {{ $flight->available_first }}</div>
    </div>
    <h3 class="text-lg font-semibold mb-2">Form Booking</h3>
    <form action="{{ route('flights.book', $flight->id) }}" method="POST" class="bg-gray-50 p-6 rounded-lg shadow">
        @csrf
        <input type="hidden" name="travel_date" value="{{ request('departure_date') }}">
        <div class="mb-4">
            <label for="class_type" class="block font-semibold mb-1">Kelas</label>
            <select name="class_type" id="class_type" class="form-input w-full" required>
                <option value="economy" {{ request('class')=='economy' ? 'selected' : '' }}>Ekonomi</option>
                <option value="business" {{ request('class')=='business' ? 'selected' : '' }}>Bisnis</option>
                <option value="first" {{ request('class')=='first' ? 'selected' : '' }}>First</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="passengers" class="block font-semibold mb-1">Jumlah Penumpang</label>
            <input type="number" name="passengers" id="passengers" class="form-input w-full" min="1" max="9" value="{{ request('passengers', 1) }}" required>
        </div>
        <button type="submit" class="btn btn-primary w-full">Pesan Tiket</button>
    </form>
    <div class="mt-6">
        <a href="{{ route('flights.search', request()->all()) }}" class="btn btn-outline">Kembali ke Hasil</a>
    </div>
</div>
@endsection
