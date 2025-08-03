@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search Summary -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        @if($type === 'hotel')
                            Hotel di {{ $from }}
                        @else
                            {{ ucfirst($type) }} dari {{ $from }} ke {{ $to }}
                        @endif
                    </h2>
                    <p class="text-gray-600 mt-1">
                        @if($type === 'hotel')
                            {{ \Carbon\Carbon::parse($date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($return_date)->format('d M Y') }}
                            · {{ $passengers }} Kamar
                        @else
                            {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
                            · {{ $passengers }} Penumpang
                        @endif
                    </p>
                </div>
                <button onclick="window.history.back()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Ubah Pencarian
                </button>
            </div>
        </div>

        <!-- Results Grid -->
        <div class="grid gap-6">
            @if($type === 'hotel')
                @foreach($results as $hotel)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="md:flex">
                            <div class="md:flex-shrink-0">
                                <img class="h-48 w-full object-cover md:w-48" src="{{ asset('images/'.$hotel['image']) }}" alt="{{ $hotel['name'] }}">
                            </div>
                            <div class="p-6 w-full">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-xl font-semibold text-gray-800">{{ $hotel['name'] }}</h3>
                                        <div class="flex items-center mt-1">
                                            @for($i = 0; $i < $hotel['rating']; $i++)
                                                <i class="fas fa-star text-yellow-400"></i>
                                            @endfor
                                        </div>
                                        <p class="text-gray-600 mt-2">{{ $hotel['address'] }}</p>
                                        <div class="flex gap-2 mt-3">
                                            @foreach($hotel['facilities'] as $facility)
                                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">
                                                    {{ $facility }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-gray-600 text-sm">Mulai dari</p>
                                        <p class="text-2xl font-bold text-gray-800">
                                            Rp {{ number_format($hotel['price'], 0, ',', '.') }}
                                        </p>
                                        <p class="text-gray-600 text-sm">per malam</p>
                                        <button class="mt-4 px-6 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600 transition-colors">
                                            Pilih Kamar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                @foreach($results as $transport)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <img src="{{ asset('images/'.$transport['logo']) }}" alt="{{ $transport['provider'] }}" class="h-12 w-12 object-contain">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $transport['provider'] }}</h3>
                                    @if(isset($transport['class']))
                                        <p class="text-gray-600">{{ $transport['class'] }}</p>
                                    @endif
                                    @if(isset($transport['type']))
                                        <p class="text-gray-600">{{ $transport['type'] }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center space-x-8">
                                <div class="text-center">
                                    <p class="text-xl font-bold text-gray-800">{{ $transport['departure'] }}</p>
                                    <p class="text-gray-600">{{ $from }}</p>
                                </div>
                                <div class="flex flex-col items-center">
                                    <div class="w-24 h-px bg-gray-300"></div>
                                    <i class="fas fa-plane text-gray-400 my-1"></i>
                                </div>
                                <div class="text-center">
                                    <p class="text-xl font-bold text-gray-800">{{ $transport['arrival'] }}</p>
                                    <p class="text-gray-600">{{ $to }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-gray-600 text-sm">Mulai dari</p>
                                    <p class="text-2xl font-bold text-gray-800">
                                        Rp {{ number_format($transport['price'], 0, ',', '.') }}
                                    </p>
                                    <button class="mt-2 px-6 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600 transition-colors">
                                        Pilih
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
