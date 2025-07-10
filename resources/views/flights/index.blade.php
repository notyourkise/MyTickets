@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-3xl font-bold mb-6 text-sky-600">Cari Tiket Pesawat</h2>
    <form action="{{ route('flights.search') }}" method="GET" class="bg-white p-6 rounded-lg shadow-md max-w-xl mx-auto">
        <div class="mb-4">
            <label for="origin" class="block font-semibold mb-1">Kota Asal</label>
            <input type="text" name="origin" id="origin" class="form-input w-full" required placeholder="Contoh: Jakarta">
        </div>
        <div class="mb-4">
            <label for="destination" class="block font-semibold mb-1">Kota Tujuan</label>
            <input type="text" name="destination" id="destination" class="form-input w-full" required placeholder="Contoh: Bali">
        </div>
        <div class="mb-4">
            <label for="departure_date" class="block font-semibold mb-1">Tanggal Berangkat</label>
            <input type="date" name="departure_date" id="departure_date" class="form-input w-full" required>
        </div>
        <div class="mb-4">
            <label for="passengers" class="block font-semibold mb-1">Jumlah Penumpang</label>
            <input type="number" name="passengers" id="passengers" class="form-input w-full" min="1" max="9" value="1" required>
        </div>
        <div class="mb-4">
            <label for="class" class="block font-semibold mb-1">Kelas</label>
            <select name="class" id="class" class="form-input w-full" required>
                <option value="economy">Ekonomi</option>
                <option value="business">Bisnis</option>
                <option value="first">First</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-full">Cari Tiket</button>
    </form>
</div>
@endsection
