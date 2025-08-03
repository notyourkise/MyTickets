<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MyTickets') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Modal Animation */
        .modal-content {
            transform: translateY(0);
            opacity: 1;
            transition: all 0.3s ease-out;
        }
        
        .modal-content.hidden {
            transform: translateY(-20px);
            opacity: 0;
        }
        
        /* Hide scrollbar for modal */
        .modal-scroll-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        .modal-scroll-hide::-webkit-scrollbar {
            display: none;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background-color: #f3f4f6;
        }
        .city-nav {
            background: #ffffff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .city-link {
            color: #1e40af;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            transition: all 0.2s;
        }
        .city-link:hover {
            background-color: #dbeafe;
        }
        .city-link.active {
            background-color: #0284c7;
            color: white;
        }
        .bg-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/images/bromo.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        .btn-sky {
            background: linear-gradient(135deg, #0ea5e9, #38bdf8);
        }
        .btn-sky:hover {
            background: linear-gradient(135deg, #0284c7, #0ea5e9);
        }
        .floating-nav {
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transform: translateY(0);
            animation: floatIn 0.5s ease-out;
            width: 90%;
            max-width: 1400px;
        }
        @keyframes floatIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .main-content {
            position: relative;
            margin: 0;
            padding: 0;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #38bdf8;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
    </style>
</head>
<body class="antialiased" x-data="{ 
    showAuthModal: false,
    authMode: 'signin',
    email: '',
    password: '',
    handleAuth() {
        if (!this.email || !this.password) {
            alert('Please enter both email and password');
            return;
        }
        if (!this.isValidEmail(this.email)) {
            alert('Please enter a valid email address');
            return;
        }
        // Here you can handle the authentication logic
        console.log('Auth mode:', this.authMode);
        console.log('Email:', this.email);
        console.log('Password:', this.password);
    },
    isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
}">
    <!-- Unified Floating Navbar -->
    <div class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 floating-nav">
        <div class="bg-gray-800/90 backdrop-blur-lg rounded-full p-2 border border-gray-700/50">
            <div class="flex items-center justify-between gap-4 px-6">
                <!-- Left side: Logo and Navigation -->
                <div class="flex items-center gap-6">
                    <!-- Logo -->
                    <a href="/" class="text-white text-xl font-bold pr-8 border-r border-gray-700/50">MyTickets</a>
                    
                    <!-- Navigation Buttons -->
                    <button 
                        @click="activeTab = 'pesawat'; $nextTick(() => initDatePickers())"
                        :class="{
                            'bg-sky-500 !text-white scale-105 shadow-lg shadow-sky-500/25': activeTab === 'pesawat',
                            '!text-white': activeTab !== 'pesawat'
                        }"
                        class="relative px-4 py-3 rounded-full font-medium flex items-center gap-2 transition-all duration-300 hover:!text-sky-400 group"
                        x-init="initDatePickers()">
                        <i class="fas fa-plane transition-transform group-hover:-rotate-45 duration-300 text-blue-400 group-hover:text-blue-300"></i>
                        <span class="relative nav-link !text-white">
                            Flights
                        </span>
                    </button>
                    <button 
                        @click="activeTab = 'kereta'; $nextTick(() => initDatePickers())"
                        :class="{
                            'bg-sky-500 !text-white scale-105 shadow-lg shadow-sky-500/25': activeTab === 'kereta',
                            '!text-white': activeTab !== 'kereta'
                        }"
                        class="relative px-4 py-3 rounded-full font-medium flex items-center gap-2 transition-all duration-300 hover:!text-sky-400 group">
                        <i class="fas fa-train transition-transform group-hover:translate-x-1 duration-300 text-amber-400 group-hover:text-amber-300"></i>
                        <span class="relative nav-link !text-white">
                            Trains
                        </span>
                    </button>
                    <button 
                        @click="activeTab = 'bus'; $nextTick(() => initDatePickers())"
                        :class="{
                            'bg-sky-500 !text-white scale-105 shadow-lg shadow-sky-500/25': activeTab === 'bus',
                            '!text-white': activeTab !== 'bus'
                        }"
                        class="relative px-4 py-3 rounded-full font-medium flex items-center gap-2 transition-all duration-300 hover:!text-sky-400 group">
                        <i class="fas fa-bus transition-transform group-hover:translate-x-1 duration-300 text-green-400 group-hover:text-green-300"></i>
                        <span class="relative nav-link !text-white">
                            Bus
                        </span>
                    </button>
                    <button 
                        @click="activeTab = 'hotel'; $nextTick(() => initDatePickers())"
                        :class="{
                            'bg-sky-500 !text-white scale-105 shadow-lg shadow-sky-500/25': activeTab === 'hotel',
                            '!text-white': activeTab !== 'hotel'
                        }"
                        class="relative px-4 py-3 rounded-full font-medium flex items-center gap-2 transition-all duration-300 hover:!text-sky-400 group">
                        <i class="fas fa-hotel transition-transform group-hover:translate-y-[-2px] duration-300 text-purple-400 group-hover:text-purple-300"></i>
                        <span class="relative nav-link !text-white">
                            Hotels
                        </span>
                    </button>
                </div>

                <!-- Right side: Auth Buttons -->
                <div class="flex items-center gap-4 pl-4 border-l border-gray-700/50">
                    <button @click="showAuthModal = true; authMode = 'signin'" class="text-gray-300 hover:text-white transition-colors relative nav-link font-medium">Sign In</button>
                    <button @click="showAuthModal = true; authMode = 'register'" class="px-4 py-2 rounded-full bg-sky-500 text-white hover:bg-sky-600 transition-all transform hover:scale-105 font-medium">Register</button>
                </div>

                <!-- Auth Modal -->
                <div x-show="showAuthModal" 
                     class="fixed inset-0 z-[100]"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    
                    <!-- Backdrop -->
                    <div class="fixed inset-0 bg-black/50"
                         @click="showAuthModal = false"></div>
                         
                    <!-- Modal Container -->
                    <div class="fixed top-[10%] left-1/2 transform -translate-x-1/2 w-[400px]">
                        <!-- Modal Content -->
                        <div class="bg-white rounded-lg relative z-[101] modal-content shadow-xl"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform translate-y-4"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 transform translate-y-0"
                         x-transition:leave-end="opacity-0 transform translate-y-4">
                        
                        <!-- Modal Header -->
                        <div class="flex justify-between items-center px-6 py-4">
                            <h2 class="text-2xl font-bold">Log In/Register</h2>
                            <button @click="showAuthModal = false" class="text-gray-400 hover:text-gray-500">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="px-6 pb-6">
                            <div class="space-y-4">
                                <!-- Email/Mobile Input -->
                                <div>
                                    <label class="block text-sm mb-2">Email/Mobile Number</label>
                                    <input type="text" 
                                           x-model="email"
                                           class="w-full px-4 py-3 rounded border border-gray-300 focus:border-blue-500 focus:ring-0 outline-none"
                                           placeholder="Example: +6281234567 or yourname@email.com">
                                </div>

                                <!-- Continue Button -->
                                <button @click="handleAuth"
                                        class="w-full py-3 px-4 bg-gray-100 text-gray-800 rounded font-medium hover:bg-gray-200 transition-colors">
                                    Continue
                                </button>

                                <!-- Divider -->
                                <div class="relative my-6">
                                    <div class="absolute inset-0 flex items-center">
                                        <div class="w-full border-t border-gray-200"></div>
                                    </div>
                                    <div class="relative flex justify-center text-sm">
                                        <span class="px-2 bg-white text-gray-500">or log in/register with</span>
                                    </div>
                                </div>

                                <!-- Google Login Button -->
                                <button class="w-full flex items-center justify-center gap-3 px-4 py-3 border border-gray-200 rounded bg-white text-gray-700 hover:bg-gray-50 transition-colors">
                                    <i class="fab fa-google"></i>
                                    <span>Google</span>
                                </button>

                                <!-- Terms and Privacy Notice -->
                                <p class="text-xs text-gray-500 text-center mt-6">
                                    By continuing, you agree to these <a href="#" class="text-blue-500">Terms & Conditions</a> and acknowledge that you have been informed about our <a href="#" class="text-blue-500">Privacy Notice</a>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button class="text-gray-300 hover:text-white focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <main class="main-content">
        <!-- Hero Section -->
        <header class="bg-hero min-h-screen flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
                <div class="text-center text-white">
                    <h1 class="text-4xl sm:text-6xl font-bold mb-4">
                        Temukan Perjalanan Impianmu
                    </h1>
                    <p class="text-xl sm:text-2xl mb-8">
                        Booking tiket transportasi dan hotel dengan mudah dan aman
                    </p>
                </div>
            </div>
        </header>

    <main>
        <!-- Partner Logos Section -->
        @php
            $partnerLogos = app(App\Http\Controllers\PartnerController::class)->getPartnerLogos();
        @endphp
        @include('components.partners-scroller', ['partnerLogos' => $partnerLogos])

        <!-- Quick Search Section -->
        <section class="py-16 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 relative -mt-32" 
                x-data="{ 
                    activeTab: 'pesawat',
                    from: '',
                    to: '',
                    date: '',
                    passengers: 1,
                    returnDate: '',
                    showPassengersDropdown: false,
                    initDatePickers() {
                        flatpickr(this.$refs.datepicker, {
                            dateFormat: 'Y-m-d',
                            minDate: 'today',
                            theme: 'dark',
                            locale: 'id',
                            disableMobile: 'true',
                            onChange: (selectedDates) => {
                                this.date = selectedDates[0].toISOString().split('T')[0];
                            }
                        });
                        
                        if (this.activeTab === 'hotel') {
                            flatpickr(this.$refs.checkinpicker, {
                                dateFormat: 'Y-m-d',
                                minDate: 'today',
                                theme: 'dark',
                                locale: 'id',
                                disableMobile: 'true',
                                onChange: (selectedDates) => {
                                    this.date = selectedDates[0].toISOString().split('T')[0];
                                    // Update checkout minimum date
                                    this.$refs.checkoutpicker._flatpickr.set('minDate', selectedDates[0]);
                                }
                            });
                            
                            flatpickr(this.$refs.checkoutpicker, {
                                dateFormat: 'Y-m-d',
                                minDate: this.date || 'today',
                                theme: 'dark',
                                locale: 'id',
                                disableMobile: 'true',
                                onChange: (selectedDates) => {
                                    this.returnDate = selectedDates[0].toISOString().split('T')[0];
                                }
                            });
                        }
                    },
                    cityList: {
                        pesawat: {
                            from: [
                                'Jakarta', 'Jambi', 'Jayapura', 'Jember',
                                'Surabaya', 'Semarang', 'Solo', 'Samarinda', 'Sorong',
                                'Bandung', 'Batam', 'Bengkulu', 'Banjarmasin', 'Balikpapan',
                                'Medan', 'Makassar', 'Malang', 'Manado', 'Mataram',
                                'Denpasar', 'Yogyakarta', 'Palembang', 'Pekanbaru', 'Pontianak', 'Padang'
                            ],
                            to: [
                                'Jakarta', 'Jambi', 'Jayapura', 'Jember',
                                'Surabaya', 'Semarang', 'Solo', 'Samarinda', 'Sorong',
                                'Bandung', 'Batam', 'Bengkulu', 'Banjarmasin', 'Balikpapan',
                                'Medan', 'Makassar', 'Malang', 'Manado', 'Mataram',
                                'Denpasar', 'Yogyakarta', 'Palembang', 'Pekanbaru', 'Pontianak', 'Padang'
                            ]
                        },
                        kereta: {
                            from: [
                                'Jakarta - Gambir', 'Jakarta - Pasar Senen',
                                'Bandung - Hall', 'Bandung - Kiaracondong',
                                'Surabaya - Gubeng', 'Surabaya - Pasar Turi',
                                'Yogyakarta - Tugu', 'Yogyakarta - Lempuyangan',
                                'Semarang - Tawang', 'Semarang - Poncol',
                                'Malang - Kota Baru', 'Solo - Balapan',
                                'Cirebon - Prujakan', 'Purwokerto', 'Madiun'
                            ],
                            to: [
                                'Jakarta - Gambir', 'Jakarta - Pasar Senen',
                                'Bandung - Hall', 'Bandung - Kiaracondong',
                                'Surabaya - Gubeng', 'Surabaya - Pasar Turi',
                                'Yogyakarta - Tugu', 'Yogyakarta - Lempuyangan',
                                'Semarang - Tawang', 'Semarang - Poncol',
                                'Malang - Kota Baru', 'Solo - Balapan',
                                'Cirebon - Prujakan', 'Purwokerto', 'Madiun'
                            ]
                        },
                        bus: {
                            from: [
                                'Jakarta - Terminal Pulo Gebang', 'Jakarta - Terminal Kampung Rambutan',
                                'Bandung - Terminal Leuwipanjang', 'Bandung - Terminal Cicaheum',
                                'Surabaya - Terminal Bungurasih', 'Semarang - Terminal Terboyo',
                                'Yogyakarta - Terminal Giwangan', 'Solo - Terminal Tirtonadi',
                                'Malang - Terminal Arjosari', 'Purwokerto - Terminal Bulupitu',
                                'Cirebon - Terminal Harjamukti'
                            ],
                            to: [
                                'Jakarta - Terminal Pulo Gebang', 'Jakarta - Terminal Kampung Rambutan',
                                'Bandung - Terminal Leuwipanjang', 'Bandung - Terminal Cicaheum',
                                'Surabaya - Terminal Bungurasih', 'Semarang - Terminal Terboyo',
                                'Yogyakarta - Terminal Giwangan', 'Solo - Terminal Tirtonadi',
                                'Malang - Terminal Arjosari', 'Purwokerto - Terminal Bulupitu',
                                'Cirebon - Terminal Harjamukti'
                            ]
                        },
                        hotel: {
                            from: [
                                'Jakarta', 'Jambi', 'Jogja', 'Jepara', 'Jember',
                                'Surabaya', 'Semarang', 'Solo', 'Samarinda',
                                'Bandung', 'Bali', 'Batam', 'Bogor', 'Balikpapan',
                                'Malang', 'Medan', 'Makassar', 'Manado',
                                'Palembang', 'Pekanbaru', 'Padang', 'Pontianak'
                            ]
                        }
                    },
                    filteredCities: {
                        from: [],
                        to: []
                    },
                    passengers: {
                        adult: 1,
                        child: 0,
                        infant: 0
                    },
                    selectedClass: 'Economy',
                    showClassDropdown: false,
                    travelClasses: {
                        pesawat: ['Economy', 'Premium Economy', 'Business', 'First Class'],
                        kereta: ['Economy', 'Business', 'Executive'],
                        bus: ['Economy', 'VIP', 'Executive'],
                        hotel: ['Standard', 'Deluxe', 'Suite', 'Presidential']
                    },
                    getTotalPassengers() {
                        return this.passengers.adult + this.passengers.child + this.passengers.infant;
                    },
                    updatePassenger(type, operation) {
                        const limits = {
                            adult: { min: 1, max: 5 },
                            child: { min: 0, max: 3 },
                            infant: { min: 0, max: 2 }
                        };
                        
                        if (operation === '+') {
                            if (this.passengers[type] < limits[type].max && this.getTotalPassengers() < 7) {
                                this.passengers[type]++;
                            }
                        } else if (operation === '-') {
                            if (this.passengers[type] > limits[type].min) {
                                this.passengers[type]--;
                            }
                        }
                    },
                    getPassengerSummary() {
                        const parts = [];
                        if (this.passengers.adult > 0) {
                            parts.push(`${this.passengers.adult} Adult`);
                        }
                        if (this.passengers.child > 0) {
                            parts.push(`${this.passengers.child} Child`);
                        }
                        if (this.passengers.infant > 0) {
                            parts.push(`${this.passengers.infant} Infant`);
                        }
                        return parts.join(', ');
                    },
                    filterCities(type, query) {
                        if (!query) {
                            this.filteredCities[type] = [];
                            return;
                        }
                        const searchQuery = query.toLowerCase();
                        this.filteredCities[type] = this.cityList[this.activeTab][type]?.filter(city => 
                            city.toLowerCase().includes(searchQuery)
                        ) || [];
                    },
                    showSuggestions: false,
                    selectedField: null,
                    handleSearch() {
                        // Validasi input
                        if (!this.from || !this.to || !this.date) {
                            alert('Mohon lengkapi semua field yang diperlukan');
                            return;
                        }
                        
                        // Redirect ke halaman pencarian dengan parameter
                        const params = new URLSearchParams({
                            type: this.activeTab,
                            from: this.from,
                            to: this.to,
                            date: this.date,
                            passengers: this.passengers
                        });
                        
                        if (this.returnDate) {
                            params.append('return_date', this.returnDate);
                        }
                        
                        window.location.href = `/search?${params.toString()}`;
                    }
                }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl border border-gray-700 p-8 shadow-xl">
                    <!-- Tabs -->
                    <div class="flex flex-wrap gap-4 mb-8">
                        <button 
                            @click="activeTab = 'pesawat'" 
                            :class="{'bg-sky-500': activeTab === 'pesawat', 'bg-gray-700 hover:bg-gray-600': activeTab !== 'pesawat'}"
                            class="px-6 py-3 rounded-lg text-white font-semibold flex items-center gap-2 transition-colors"
                            x-init="initDatePickers()"
                            @click="activeTab = 'pesawat'; $nextTick(() => initDatePickers())">
                            <i class="fas fa-plane"></i>
                            Pesawat
                        </button>
                        <button 
                            @click="activeTab = 'kereta'; $nextTick(() => initDatePickers())"
                            :class="{'bg-sky-500': activeTab === 'kereta', 'bg-gray-700 hover:bg-gray-600': activeTab !== 'kereta'}"
                            class="px-6 py-3 rounded-lg text-white font-semibold flex items-center gap-2 transition-colors">
                            <i class="fas fa-train"></i>
                            Kereta Api
                        </button>
                        <button 
                            @click="activeTab = 'bus'; $nextTick(() => initDatePickers())"
                            :class="{'bg-sky-500': activeTab === 'bus', 'bg-gray-700 hover:bg-gray-600': activeTab !== 'bus'}"
                            class="px-6 py-3 rounded-lg text-white font-semibold flex items-center gap-2 transition-colors">
                            <i class="fas fa-bus"></i>
                            Bus
                        </button>
                        <button 
                            @click="activeTab = 'hotel'; $nextTick(() => initDatePickers())"
                            :class="{'bg-sky-500': activeTab === 'hotel', 'bg-gray-700 hover:bg-gray-600': activeTab !== 'hotel'}"
                            class="px-6 py-3 rounded-lg text-white font-semibold flex items-center gap-2 transition-colors">
                            <i class="fas fa-hotel"></i>
                            Hotel
                        </button>
                    </div>

                    <!-- Search Form -->
                    <form @submit.prevent="handleSearch" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <!-- From Field -->
                            <div class="relative" x-show="activeTab !== 'hotel'">
                                <label class="block text-gray-400 text-sm mb-2">Dari</label>
                                <div class="relative">
                                    <input 
                                        type="text" 
                                        x-model="from"
                                        @input="filterCities('from', $event.target.value)"
                                        @focus="selectedField = 'from'; showSuggestions = true"
                                        @click.away="setTimeout(() => { showSuggestions = false; filteredCities.from = [] }, 200)"
                                        class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:border-sky-500 transition-colors" 
                                        :placeholder="activeTab === 'pesawat' ? 'Kota Keberangkatan' : 'Stasiun/Terminal Keberangkatan'">
                                    <i :class="{
                                        'fas fa-plane-departure': activeTab === 'pesawat',
                                        'fas fa-train': activeTab === 'kereta',
                                        'fas fa-bus': activeTab === 'bus'
                                    }" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                    
                                    <!-- Filtered Cities Dropdown -->
                                    <div x-show="showSuggestions && selectedField === 'from' && filteredCities.from.length > 0" 
                                         class="absolute z-50 w-full mt-1 bg-gray-700 border border-gray-600 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                        <template x-for="city in filteredCities.from" :key="city">
                                            <div @click="from = city; showSuggestions = false; filteredCities.from = []"
                                                 class="px-4 py-2 hover:bg-gray-600 cursor-pointer text-white"
                                                 x-text="city">
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- To Field -->
                            <div class="relative" x-show="activeTab !== 'hotel'">
                                <label class="block text-gray-400 text-sm mb-2">Ke</label>
                                <div class="relative">
                                    <input 
                                        type="text" 
                                        x-model="to"
                                        @input="filterCities('to', $event.target.value)"
                                        @focus="selectedField = 'to'; showSuggestions = true"
                                        @click.away="setTimeout(() => { showSuggestions = false; filteredCities.to = [] }, 200)"
                                        class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:border-sky-500 transition-colors" 
                                        :placeholder="activeTab === 'pesawat' ? 'Kota Tujuan' : 'Stasiun/Terminal Tujuan'">
                                    <i :class="{
                                        'fas fa-plane-arrival': activeTab === 'pesawat',
                                        'fas fa-train': activeTab === 'kereta',
                                        'fas fa-bus': activeTab === 'bus'
                                    }" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                    
                                    <!-- Filtered Cities Dropdown -->
                                    <div x-show="showSuggestions && selectedField === 'to' && filteredCities.to.length > 0" 
                                         class="absolute z-50 w-full mt-1 bg-gray-700 border border-gray-600 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                        <template x-for="city in filteredCities.to" :key="city">
                                            <div @click="to = city; showSuggestions = false; filteredCities.to = []"
                                                 class="px-4 py-2 hover:bg-gray-600 cursor-pointer text-white"
                                                 x-text="city">
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <!-- Hotel Location -->
                            <div class="relative" x-show="activeTab === 'hotel'">
                                <label class="block text-gray-400 text-sm mb-2">Lokasi</label>
                                <div class="relative">
                                    <input 
                                        type="text" 
                                        x-model="from"
                                        @focus="selectedField = 'from'; showSuggestions = true"
                                        @click.away="showSuggestions = false"
                                        class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:border-sky-500 transition-colors" 
                                        placeholder="Kota/Area Hotel">
                                    <i class="fas fa-map-marker-alt absolute right-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                    
                                    <!-- Suggestions Dropdown -->
                                    <div x-show="showSuggestions && selectedField === 'from'" 
                                         class="absolute z-50 w-full mt-1 bg-gray-700 border border-gray-600 rounded-lg shadow-lg">
                                        <template x-for="suggestion in suggestions[activeTab].from" :key="suggestion">
                                            <div @click="from = suggestion; showSuggestions = false"
                                                 class="px-4 py-2 hover:bg-gray-600 cursor-pointer text-white"
                                                 x-text="suggestion">
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <!-- Date Fields -->
                            <div class="relative" x-show="activeTab !== 'hotel'">
                                <label class="block text-gray-400 text-sm mb-2">Tanggal Pergi</label>
                                <div class="relative">
                                    <input type="text" 
                                           x-model="date"
                                           x-ref="datepicker"
                                           class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:border-sky-500 transition-colors"
                                           placeholder="Pilih tanggal"
                                           readonly>
                                    <i class="fas fa-calendar absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 cursor-pointer"
                                       @click="$refs.datepicker.focus()"></i>
                                </div>
                            </div>

                            <!-- Hotel Date Range -->
                            <div class="grid grid-cols-2 gap-4" x-show="activeTab === 'hotel'">
                                <div class="relative">
                                    <label class="block text-gray-400 text-sm mb-2">Check In</label>
                                    <div class="relative">
                                        <input type="text" 
                                               x-model="date"
                                               x-ref="checkinpicker"
                                               class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:border-sky-500 transition-colors"
                                               placeholder="Pilih tanggal"
                                               readonly>
                                        <i class="fas fa-calendar absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 cursor-pointer"
                                           @click="$refs.checkinpicker.focus()"></i>
                                    </div>
                                </div>
                                <div class="relative">
                                    <label class="block text-gray-400 text-sm mb-2">Check Out</label>
                                    <div class="relative">
                                        <input type="text" 
                                               x-model="returnDate"
                                               x-ref="checkoutpicker"
                                               class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:border-sky-500 transition-colors"
                                               placeholder="Pilih tanggal"
                                               readonly>
                                        <i class="fas fa-calendar absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 cursor-pointer"
                                           @click="$refs.checkoutpicker.focus()"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Passengers and Class Selection -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Passengers Dropdown -->
                                <div class="relative">
                                    <label class="block text-gray-400 text-sm mb-2">
                                        <span x-show="activeTab !== 'hotel'">Penumpang</span>
                                        <span x-show="activeTab === 'hotel'">Tamu</span>
                                    </label>
                                    <div class="relative">
                                        <button 
                                            type="button"
                                            @click="showPassengersDropdown = !showPassengersDropdown"
                                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white text-left focus:outline-none focus:border-sky-500 transition-colors">
                                            <span x-text="getPassengerSummary()"></span>
                                        </button>
                                        <i class="fas fa-users absolute right-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                        
                                        <!-- Passengers Selection Dropdown -->
                                        <div x-show="showPassengersDropdown" 
                                             @click.away="showPassengersDropdown = false"
                                             class="absolute z-50 w-[300px] mt-1 bg-gray-700 border border-gray-600 rounded-lg shadow-lg p-4">
                                            <!-- Adult Selection -->
                                            <div class="flex items-center justify-between mb-4">
                                                <div>
                                                    <p class="text-white font-medium">Adult</p>
                                                    <p class="text-gray-400 text-sm">Age 12 and over</p>
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    <button type="button" 
                                                            @click="updatePassenger('adult', '-')"
                                                            :class="{'opacity-50 cursor-not-allowed': passengers.adult <= 1}"
                                                            class="w-8 h-8 rounded-full bg-gray-600 text-white flex items-center justify-center hover:bg-gray-500">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <span class="text-white w-4 text-center" x-text="passengers.adult"></span>
                                                    <button type="button"
                                                            @click="updatePassenger('adult', '+')"
                                                            class="w-8 h-8 rounded-full bg-gray-600 text-white flex items-center justify-center hover:bg-gray-500">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            <!-- Child Selection -->
                                            <div class="flex items-center justify-between mb-4">
                                                <div>
                                                    <p class="text-white font-medium">Child</p>
                                                    <p class="text-gray-400 text-sm">Age 2 - 11</p>
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    <button type="button" 
                                                            @click="updatePassenger('child', '-')"
                                                            :class="{'opacity-50 cursor-not-allowed': passengers.child <= 0}"
                                                            class="w-8 h-8 rounded-full bg-gray-600 text-white flex items-center justify-center hover:bg-gray-500">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <span class="text-white w-4 text-center" x-text="passengers.child"></span>
                                                    <button type="button"
                                                            @click="updatePassenger('child', '+')"
                                                            class="w-8 h-8 rounded-full bg-gray-600 text-white flex items-center justify-center hover:bg-gray-500">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            <!-- Infant Selection -->
                                            <div class="flex items-center justify-between mb-4">
                                                <div>
                                                    <p class="text-white font-medium">Infant</p>
                                                    <p class="text-gray-400 text-sm">Below age 2</p>
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    <button type="button" 
                                                            @click="updatePassenger('infant', '-')"
                                                            :class="{'opacity-50 cursor-not-allowed': passengers.infant <= 0}"
                                                            class="w-8 h-8 rounded-full bg-gray-600 text-white flex items-center justify-center hover:bg-gray-500">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <span class="text-white w-4 text-center" x-text="passengers.infant"></span>
                                                    <button type="button"
                                                            @click="updatePassenger('infant', '+')"
                                                            class="w-8 h-8 rounded-full bg-gray-600 text-white flex items-center justify-center hover:bg-gray-500">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Done Button -->
                                            <button 
                                                @click="showPassengersDropdown = false"
                                                class="w-full mt-2 px-4 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600 transition-colors">
                                                Done
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Class Selection -->
                                <div class="relative" x-show="activeTab !== 'hotel'">
                                    <label class="block text-gray-400 text-sm mb-2">Kelas</label>
                                    <div class="relative">
                                        <button 
                                            type="button"
                                            @click="showClassDropdown = !showClassDropdown"
                                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white text-left focus:outline-none focus:border-sky-500 transition-colors">
                                            <span x-text="selectedClass"></span>
                                        </button>
                                        <i class="fas fa-chair absolute right-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                        
                                        <!-- Class Selection Dropdown -->
                                        <div x-show="showClassDropdown" 
                                             @click.away="showClassDropdown = false"
                                             class="absolute z-50 w-full mt-1 bg-gray-700 border border-gray-600 rounded-lg shadow-lg">
                                            <template x-for="travelClass in travelClasses[activeTab]" :key="travelClass">
                                                <button 
                                                    @click="selectedClass = travelClass; showClassDropdown = false"
                                                    class="w-full px-4 py-2 text-left text-white hover:bg-gray-600 transition-colors first:rounded-t-lg last:rounded-b-lg"
                                                    :class="{'bg-sky-500 hover:bg-sky-600': selectedClass === travelClass}"
                                                    x-text="travelClass">
                                                </button>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Search Button -->
                        <div class="mt-8 text-center">
                            <button type="submit"
                                    class="px-8 py-4 bg-gradient-to-r from-sky-500 to-sky-600 text-white font-semibold rounded-lg hover:from-sky-600 hover:to-sky-700 transform hover:-translate-y-1 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center mx-auto gap-2">
                                <i class="fas fa-search"></i>
                                <span x-text="activeTab === 'hotel' ? 'Cari Hotel' : 'Cari Tiket'"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Promo Section -->
        <section class="py-16 bg-white relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-sky-50 to-white opacity-50"></div>
            
            <!-- Section Header -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <span class="text-sky-600 font-semibold tracking-wider uppercase text-sm">Promo Spesial</span>
                    <h2 class="text-3xl font-bold text-gray-900 mt-2">
                        Kupon Diskon untuk Anda
                    </h2>
                </div>

                <!-- Ticket/Coupon Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Ticket 1 -->
                    <div class="group">
                        <div class="relative bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                            <!-- Ticket Border Pattern -->
                            <div class="absolute left-0 top-0 h-full w-1 bg-sky-500"></div>
                            <div class="absolute right-0 top-0 h-full w-[3px] bg-gradient-to-b from-transparent via-gray-200 to-transparent"></div>
                            
                            <!-- Ticket Content -->
                            <div class="p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3">
                                            <i class="fas fa-plane text-sky-500 text-2xl"></i>
                                            <div>
                                                <span class="inline-block px-2 py-0.5 bg-sky-100 text-sky-700 rounded-full text-xs font-medium">
                                                    First Transaction
                                                </span>
                                                <h3 class="text-lg font-bold text-gray-900 mt-1">Diskon Tiket Pesawat</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right ml-4">
                                        <span class="text-3xl font-bold text-sky-600">8%</span>
                                        <p class="text-xs text-gray-500">OFF</p>
                                    </div>
                                </div>
                                
                                <div class="mt-3 space-y-1">
                                    <p class="text-sm text-gray-600">Potongan hingga Rp 240rb</p>
                                    <p class="text-xs text-gray-500">Min. transaksi Rp 2jt</p>
                                </div>

                                <!-- Dotted Line -->
                                <div class="my-3 border-t-2 border-dashed border-sky-500/50"></div>

                                <!-- Coupon Code -->
                                <div class="flex items-center justify-between">
                                    <div class="bg-sky-50 px-3 py-1.5 rounded flex items-center gap-2">
                                        <i class="fas fa-ticket-alt text-sky-500 text-sm"></i>
                                        <code class="text-gray-800 font-mono text-sm">JALANYUK</code>
                                    </div>
                                    <button class="text-sky-600 hover:text-sky-700 font-medium flex items-center gap-1 text-sm">
                                        <i class="fas fa-copy"></i>
                                        Salin
                                    </button>
                                </div>
                            </div>

                            <!-- Ticket Edge Circles -->
                            <div class="absolute -left-3 top-1/2 transform -translate-y-1/2 w-6 h-6 bg-sky-50 rounded-full border-2 border-dashed border-sky-500/50"></div>
                            <div class="absolute -right-3 top-1/2 transform -translate-y-1/2 w-6 h-6 bg-sky-50 rounded-full border-2 border-dashed border-sky-500/50"></div>
                        </div>
                    </div>

                    <!-- Ticket 2 -->
                    <div class="group">
                        <div class="relative bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                            <!-- Ticket Border Pattern -->
                            <div class="absolute left-0 top-0 h-full w-1 bg-sky-500"></div>
                            <div class="absolute right-0 top-0 h-full w-[3px] bg-gradient-to-b from-transparent via-gray-200 to-transparent"></div>
                            
                            <!-- Ticket Content -->
                            <div class="p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3">
                                            <i class="fas fa-hotel text-sky-500 text-2xl"></i>
                                            <div>
                                                <span class="inline-block px-2 py-0.5 bg-sky-100 text-sky-700 rounded-full text-xs font-medium">
                                                    Hotel Deals
                                                </span>
                                                <h3 class="text-lg font-bold text-gray-900 mt-1">Diskon Hotel</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right ml-4">
                                        <span class="text-3xl font-bold text-sky-600">8%</span>
                                        <p class="text-xs text-gray-500">OFF</p>
                                    </div>
                                </div>
                                
                                <div class="mt-3 space-y-1">
                                    <p class="text-sm text-gray-600">Potongan hingga Rp 500rb</p>
                                    <p class="text-xs text-gray-500">Min. transaksi Rp 500rb</p>
                                </div>

                                <!-- Dotted Line -->
                                <div class="my-3 border-t-2 border-dashed border-sky-500/50"></div>

                                <!-- Coupon Code -->
                                <div class="flex items-center justify-between">
                                    <div class="bg-sky-50 px-3 py-1.5 rounded flex items-center gap-2">
                                        <i class="fas fa-ticket-alt text-sky-500 text-sm"></i>
                                        <code class="text-gray-800 font-mono text-sm">JALANYUK</code>
                                    </div>
                                    <button class="text-sky-600 hover:text-sky-700 font-medium flex items-center gap-1 text-sm">
                                        <i class="fas fa-copy"></i>
                                        Salin
                                    </button>
                                </div>
                            </div>

                            <!-- Ticket Edge Circles -->
                            <div class="absolute -left-3 top-1/2 transform -translate-y-1/2 w-6 h-6 bg-sky-50 rounded-full border-2 border-dashed border-sky-500/50"></div>
                            <div class="absolute -right-3 top-1/2 transform -translate-y-1/2 w-6 h-6 bg-sky-50 rounded-full border-2 border-dashed border-sky-500/50"></div>
                        </div>
                    </div>

                    <!-- Ticket 3 -->
                    <div class="group">
                        <div class="relative bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                            <!-- Ticket Border Pattern -->
                            <div class="absolute left-0 top-0 h-full w-1 bg-sky-500"></div>
                            <div class="absolute right-0 top-0 h-full w-[3px] bg-gradient-to-b from-transparent via-gray-200 to-transparent"></div>
                            
                            <!-- Ticket Content -->
                            <div class="p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3">
                                            <i class="fas fa-map-marked-alt text-sky-500 text-2xl"></i>
                                            <div>
                                                <span class="inline-block px-2 py-0.5 bg-sky-100 text-sky-700 rounded-full text-xs font-medium">
                                                    Experience
                                                </span>
                                                <h3 class="text-lg font-bold text-gray-900 mt-1">Diskon Xperience</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right ml-4">
                                        <span class="text-3xl font-bold text-sky-600">8%</span>
                                        <p class="text-xs text-gray-500">OFF</p>
                                    </div>
                                </div>
                                
                                <div class="mt-3 space-y-1">
                                    <p class="text-sm text-gray-600">Potongan hingga Rp 300rb</p>
                                    <p class="text-xs text-gray-500">Min. transaksi Rp 300rb</p>
                                </div>

                                <!-- Dotted Line -->
                                <div class="my-3 border-t-2 border-dashed border-sky-500/50"></div>

                                <!-- Coupon Code -->
                                <div class="flex items-center justify-between">
                                    <div class="bg-sky-50 px-3 py-1.5 rounded flex items-center gap-2">
                                        <i class="fas fa-ticket-alt text-sky-500 text-sm"></i>
                                        <code class="text-gray-800 font-mono text-sm">JALANYUK</code>
                                    </div>
                                    <button class="text-sky-600 hover:text-sky-700 font-medium flex items-center gap-1 text-sm">
                                        <i class="fas fa-copy"></i>
                                        Salin
                                    </button>
                                </div>
                            </div>

                            <!-- Ticket Edge Circles -->
                            <div class="absolute -left-3 top-1/2 transform -translate-y-1/2 w-6 h-6 bg-gray-100 rounded-full"></div>
                            <div class="absolute -right-3 top-1/2 transform -translate-y-1/2 w-6 h-6 bg-gray-100 rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Popular Destinations Section -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <span class="text-sky-600 font-semibold tracking-wider uppercase text-sm">Jelajahi Indonesia</span>
                    <h2 class="text-3xl font-bold text-gray-900 mt-2 mb-4">
                        Destinasi Populer
                    </h2>
                    <p class="text-gray-600">Temukan destinasi menarik dengan penawaran terbaik untuk perjalanan tak terlupakan</p>
                </div>

                <!-- Destinations Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Destination 1: Bali -->
                    <div class="group relative overflow-hidden rounded-xl">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="{{ asset('images/bali.jpg') }}" alt="Bali" class="object-cover w-full h-full transform group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/50 to-transparent">
                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                <h3 class="text-white text-xl font-bold mb-2">Bali</h3>
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-plane-departure text-sky-400"></i>
                                        <span class="text-white text-sm">Mulai dari</span>
                                        <span class="text-sky-400 font-bold">Rp 800rb</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-hotel text-sky-400"></i>
                                        <span class="text-white text-sm">Mulai dari</span>
                                        <span class="text-sky-400 font-bold">Rp 300rb</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="absolute inset-0" aria-label="Lihat detail Bali"></a>
                    </div>

                    <!-- Destination 2: Yogyakarta -->
                    <div class="group relative overflow-hidden rounded-xl">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="{{ asset('images/jogjakarta.jpg') }}" alt="Yogyakarta" class="object-cover w-full h-full transform group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/50 to-transparent">
                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                <h3 class="text-white text-xl font-bold mb-2">Yogyakarta</h3>
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-plane-departure text-sky-400"></i>
                                        <span class="text-white text-sm">Mulai dari</span>
                                        <span class="text-sky-400 font-bold">Rp 600rb</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-hotel text-sky-400"></i>
                                        <span class="text-white text-sm">Mulai dari</span>
                                        <span class="text-sky-400 font-bold">Rp 200rb</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="absolute inset-0" aria-label="Lihat detail Yogyakarta"></a>
                    </div>

                    <!-- Destination 3: Raja Ampat -->
                    <div class="group relative overflow-hidden rounded-xl">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="{{ asset('images/raja_ampat.jpg') }}" alt="Raja Ampat" class="object-cover w-full h-full transform group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/50 to-transparent">
                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                <h3 class="text-white text-xl font-bold mb-2">Raja Ampat</h3>
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-plane-departure text-sky-400"></i>
                                        <span class="text-white text-sm">Mulai dari</span>
                                        <span class="text-sky-400 font-bold">Rp 2.5jt</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-hotel text-sky-400"></i>
                                        <span class="text-white text-sm">Mulai dari</span>
                                        <span class="text-sky-400 font-bold">Rp 500rb</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="absolute inset-0" aria-label="Lihat detail Raja Ampat"></a>
                    </div>
                </div>

                <!-- View All Button -->
                <div class="text-center mt-12">
                    <a href="#" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-sky-500 text-white font-semibold hover:bg-sky-600 transition-colors">
                        Lihat Semua Destinasi
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- Flight Deals Section -->
        <section class="py-16 bg-gray-100" x-data="{ selectedCity: 'Surabaya' }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-8">
                    <span class="text-sky-600 font-semibold tracking-wider uppercase text-sm">Penerbangan Populer</span>
                    <h2 class="text-3xl font-bold text-gray-900 mt-2 mb-4">
                        Penawaran Terbaik untuk Anda
                    </h2>
                    <p class="text-gray-600">Temukan harga tiket pesawat termurah ke berbagai destinasi</p>
                </div>

                <!-- City Navigation -->
                <div class="mb-8">
                    <div class="flex items-center justify-center space-x-6 overflow-x-auto whitespace-nowrap py-2">
                        <button 
                            @click="selectedCity = 'Medan'" 
                            :class="{ 'active': selectedCity === 'Medan' }" 
                            class="city-link">Medan</button>
                        <button 
                            @click="selectedCity = 'Bali'" 
                            :class="{ 'active': selectedCity === 'Bali' }" 
                            class="city-link">Bali</button>
                        <button 
                            @click="selectedCity = 'Surabaya'" 
                            :class="{ 'active': selectedCity === 'Surabaya' }" 
                            class="city-link">Surabaya</button>
                        <button 
                            @click="selectedCity = 'Balikpapan'" 
                            :class="{ 'active': selectedCity === 'Balikpapan' }" 
                            class="city-link">Balikpapan</button>
                        <button 
                            @click="selectedCity = 'Lampung'" 
                            :class="{ 'active': selectedCity === 'Lampung' }" 
                            class="city-link">Lampung</button>
                        <button 
                            @click="selectedCity = 'Jakarta'" 
                            :class="{ 'active': selectedCity === 'Jakarta' }" 
                            class="city-link">Jakarta</button>
                    </div>
                </div>

                <!-- Flight Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Surabaya Flights -->
                    <template x-if="selectedCity === 'Surabaya'">
                        <div class="contents">
                            <!-- Jakarta to Surabaya -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/surabaya.jpg') }}" alt="Surabaya" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Jakarta - Surabaya</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">15 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 856.200</p>
                                            <p class="text-sky-600 font-bold">Rp 756.200</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Medan to Surabaya -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/surabaya.jpg') }}" alt="Surabaya" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Medan - Surabaya</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">18 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.350.000</p>
                                            <p class="text-sky-600 font-bold">Rp 1.150.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Bali to Surabaya -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/surabaya.jpg') }}" alt="Surabaya" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Bali - Surabaya</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">20 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 750.000</p>
                                            <p class="text-sky-600 font-bold">Rp 625.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Balikpapan to Surabaya -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/surabaya.jpg') }}" alt="Surabaya" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Balikpapan - Surabaya</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">22 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.150.000</p>
                                            <p class="text-sky-600 font-bold">Rp 950.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Balikpapan Flights -->
                    <template x-if="selectedCity === 'Balikpapan'">
                        <div class="contents">
                            <!-- Jakarta to Balikpapan -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/balikpapan.jpg') }}" alt="Balikpapan" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Jakarta - Balikpapan</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">15 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.256.200</p>
                                            <p class="text-sky-600 font-bold">Rp 1.056.200</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Medan to Balikpapan -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/balikpapan.jpg') }}" alt="Balikpapan" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Medan - Balikpapan</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">18 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.550.000</p>
                                            <p class="text-sky-600 font-bold">Rp 1.350.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Bali to Balikpapan -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/balikpapan.jpg') }}" alt="Balikpapan" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Bali - Balikpapan</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">20 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.250.000</p>
                                            <p class="text-sky-600 font-bold">Rp 1.050.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Surabaya to Balikpapan -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/balikpapan.jpg') }}" alt="Balikpapan" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Surabaya - Balikpapan</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">22 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.150.000</p>
                                            <p class="text-sky-600 font-bold">Rp 950.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Medan Flights -->
                    <template x-if="selectedCity === 'Medan'">
                        <div class="contents">
                            <!-- Jakarta to Medan -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/medan.jpg') }}" alt="Medan" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Jakarta - Medan</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">29 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.212.400</p>
                                            <p class="text-sky-600 font-bold">Rp 1.012.400</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Bali to Medan -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/medan.jpg') }}" alt="Medan" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Bali - Medan</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">30 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.450.000</p>
                                            <p class="text-sky-600 font-bold">Rp 1.225.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Surabaya to Medan -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/medan.jpg') }}" alt="Medan" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Surabaya - Medan</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">28 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.350.000</p>
                                            <p class="text-sky-600 font-bold">Rp 1.150.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Balikpapan to Medan -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/medan.jpg') }}" alt="Medan" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Balikpapan - Medan</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">31 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.550.000</p>
                                            <p class="text-sky-600 font-bold">Rp 1.332.100</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Lampung Flights -->
                    <template x-if="selectedCity === 'Lampung'">
                        <div class="contents">
                            <!-- Jakarta to Lampung -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/lampung.jpg') }}" alt="Lampung" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Jakarta - Lampung</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">15 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 856.200</p>
                                            <p class="text-sky-600 font-bold">Rp 756.200</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Medan to Lampung -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/lampung.jpg') }}" alt="Lampung" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Medan - Lampung</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">18 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.250.000</p>
                                            <p class="text-sky-600 font-bold">Rp 1.050.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Surabaya to Lampung -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/lampung.jpg') }}" alt="Lampung" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Surabaya - Lampung</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">20 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 950.000</p>
                                            <p class="text-sky-600 font-bold">Rp 825.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Balikpapan to Lampung -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/lampung.jpg') }}" alt="Lampung" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Balikpapan - Lampung</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">22 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.150.000</p>
                                            <p class="text-sky-600 font-bold">Rp 950.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Bali Flights -->
                    <template x-if="selectedCity === 'Bali'">
                        <div class="contents">
                            <!-- Jakarta to Bali -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/bali.jpg') }}" alt="Bali" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Jakarta - Bali</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">15 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 956.200</p>
                                            <p class="text-sky-600 font-bold">Rp 856.200</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Medan to Bali -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/medan.jpg') }}" alt="Medan" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Medan - Bali</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">18 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.350.000</p>
                                            <p class="text-sky-600 font-bold">Rp 1.150.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Surabaya to Bali -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/surabaya.jpg') }}" alt="Surabaya" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Surabaya - Bali</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">20 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 750.000</p>
                                            <p class="text-sky-600 font-bold">Rp 625.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Balikpapan to Bali -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/balikpapan.jpg') }}" alt="Balikpapan" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Balikpapan - Bali</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">22 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.250.000</p>
                                            <p class="text-sky-600 font-bold">Rp 1.050.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Jakarta Flights -->
                    <template x-if="selectedCity === 'Jakarta'">
                        <div class="contents">
                            <!-- Medan to Jakarta -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/jakarta.jpg') }}" alt="Jakarta" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Medan - Jakarta</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">15 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.212.400</p>
                                            <p class="text-sky-600 font-bold">Rp 1.012.400</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Bali to Jakarta -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/jakarta.jpg') }}" alt="Jakarta" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Bali - Jakarta</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">18 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 956.200</p>
                                            <p class="text-sky-600 font-bold">Rp 856.200</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Surabaya to Jakarta -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/jakarta.jpg') }}" alt="Jakarta" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Surabaya - Jakarta</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">20 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 850.000</p>
                                            <p class="text-sky-600 font-bold">Rp 725.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Balikpapan to Jakarta -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="relative h-40">
                                    <img src="{{ asset('images/jakarta.jpg') }}" alt="Jakarta" class="w-full h-full object-cover">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-black/70 text-white px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm">ONE-WAY</span>
                                    </div>
                                </div>
                                <div class="h-[1px] bg-gray-200"></div>
                                <div class="p-4">
                                    <h3 class="text-gray-900 font-semibold">Balikpapan - Jakarta</h3>
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-gray-500 text-sm">22 Aug 2025</p>
                                        <div class="text-right">
                                            <p class="text-gray-400 line-through text-sm">Rp 1.250.000</p>
                                            <p class="text-sky-600 font-bold">Rp 1.050.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                <!-- View All Button -->
                <div class="text-center mt-12">
                    <a href="#" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-sky-500 text-white font-semibold hover:bg-sky-600 transition-colors">
                        Lihat Semua Penerbangan
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="py-16 bg-gradient-to-br from-sky-500 to-sky-600 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <pattern id="dots" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                        <circle cx="10" cy="10" r="2" fill="currentColor"/>
                    </pattern>
                    <rect x="0" y="0" width="100%" height="100%" fill="url(#dots)"/>
                </svg>
            </div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="max-w-3xl mx-auto text-center">
                    <h2 class="text-3xl font-bold text-white mb-4">
                        Dapatkan Penawaran Eksklusif
                    </h2>
                    <p class="text-sky-100 mb-8">
                        Berlangganan newsletter kami dan dapatkan info promo terbaru langsung di inbox Anda
                    </p>
                    
                    <!-- Newsletter Form -->
                    <form class="flex flex-col sm:flex-row gap-4 justify-center max-w-md mx-auto">
                        <input 
                            type="email" 
                            placeholder="Masukkan email Anda" 
                            class="flex-1 px-6 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-sky-500"
                        >
                        <button type="submit" class="px-6 py-3 bg-white text-sky-600 font-semibold rounded-lg hover:bg-sky-50 transition-colors">
                            Berlangganan
                        </button>
                    </form>
                    
                    <!-- Privacy Notice -->
                    <p class="text-sky-100 text-sm mt-4">
                        Kami menghargai privasi Anda. Unsubscribe kapan saja.
                    </p>
                </div>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section class="py-20 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 relative overflow-hidden">
            <!-- Industrial Pattern Background -->
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
                </div>
            </div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-4xl font-bold text-white mb-4 tracking-tight">
                        Kenapa Memilih MyTickets?
                    </h2>
                    <div class="w-24 h-1 bg-sky-500 mx-auto mb-6"></div>
                    <p class="text-lg text-gray-300">
                        Platform pemesanan tiket terpercaya dengan berbagai keunggulan untuk perjalanan nyaman Anda
                    </p>
                </div>

                <!-- Features Carousel -->
                <div class="relative" x-data="{ 
                    activeSlide: 0,
                    scroll(direction) {
                        const container = $refs.carousel;
                        const scrollAmount = direction === 'next' ? 600 : -600;
                        container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                    }
                }">
                    <!-- Cards Container with Snap Scroll -->
                    <div class="flex overflow-x-auto snap-x snap-mandatory gap-6 pb-6 -mx-4 px-4 scrollbar-hide" x-ref="carousel">
                        <!-- Hide scrollbar -->
                        <style>
                            .scrollbar-hide::-webkit-scrollbar {
                                display: none;
                            }
                            .scrollbar-hide {
                                -ms-overflow-style: none;
                                scrollbar-width: none;
                            }
                        </style>
                        <!-- Feature 1: Easy Booking -->
                        <div class="group flex-none w-[300px] snap-center">
                            <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg p-6 border border-gray-700 relative overflow-hidden transition-all duration-500 hover:bg-gray-700/50 hover:border-sky-500 hover:-translate-y-2">
                                <div class="absolute top-0 left-0 w-2 h-0 bg-sky-500 transition-all duration-500 group-hover:h-full"></div>
                                <div class="relative">
                                    <div class="w-14 h-14 rounded-lg bg-sky-500/10 text-sky-500 flex items-center justify-center mb-4 transform transition-all duration-500 group-hover:scale-110 group-hover:rotate-6">
                                        <i class="fas fa-ticket-alt text-xl"></i>
                                    </div>
                                    <h3 class="text-lg font-bold text-white mb-2 group-hover:text-sky-400 transition-colors duration-300">
                                        Pemesanan Mudah
                                    </h3>
                                    <p class="text-sm text-gray-400 group-hover:text-gray-300 transition-colors duration-300">
                                        Pesan tiket dalam hitungan menit dengan interface yang user-friendly
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 2: Best Price -->
                        <div class="group flex-none w-[300px] snap-center">
                            <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg p-6 border border-gray-700 relative overflow-hidden transition-all duration-500 hover:bg-gray-700/50 hover:border-sky-500 hover:-translate-y-2">
                                <div class="absolute top-0 left-0 w-2 h-0 bg-sky-500 transition-all duration-500 group-hover:h-full"></div>
                                <div class="relative">
                                    <div class="w-14 h-14 rounded-lg bg-amber-500/10 text-amber-500 flex items-center justify-center mb-4 transform transition-all duration-500 group-hover:scale-110 group-hover:rotate-6">
                                        <i class="fas fa-tags text-xl"></i>
                                    </div>
                                    <h3 class="text-lg font-bold text-white mb-2 group-hover:text-amber-400 transition-colors duration-300">
                                        Harga Terbaik
                                    </h3>
                                    <p class="text-sm text-gray-400 group-hover:text-gray-300 transition-colors duration-300">
                                        Dapatkan harga termurah dengan berbagai promo menarik
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 3: 24/7 Support -->
                        <div class="group flex-none w-[300px] snap-center">
                            <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg p-6 border border-gray-700 relative overflow-hidden transition-all duration-500 hover:bg-gray-700/50 hover:border-sky-500 hover:-translate-y-2">
                                <div class="absolute top-0 left-0 w-2 h-0 bg-green-500 transition-all duration-500 group-hover:h-full"></div>
                                <div class="relative">
                                    <div class="w-14 h-14 rounded-lg bg-green-500/10 text-green-500 flex items-center justify-center mb-4 transform transition-all duration-500 group-hover:scale-110 group-hover:rotate-6">
                                        <i class="fas fa-headset text-xl"></i>
                                    </div>
                                    <h3 class="text-lg font-bold text-white mb-2 group-hover:text-green-400 transition-colors duration-300">
                                        Bantuan 24/7
                                    </h3>
                                    <p class="text-sm text-gray-400 group-hover:text-gray-300 transition-colors duration-300">
                                        Tim support siap membantu Anda 24 jam setiap hari
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 4: Secure Payment -->
                        <div class="group flex-none w-[300px] snap-center">
                            <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg p-6 border border-gray-700 relative overflow-hidden transition-all duration-500 hover:bg-gray-700/50 hover:border-sky-500 hover:-translate-y-2">
                                <div class="absolute top-0 left-0 w-2 h-0 bg-purple-500 transition-all duration-500 group-hover:h-full"></div>
                                <div class="relative">
                                    <div class="w-14 h-14 rounded-lg bg-purple-500/10 text-purple-500 flex items-center justify-center mb-4 transform transition-all duration-500 group-hover:scale-110 group-hover:rotate-6">
                                        <i class="fas fa-shield-alt text-xl"></i>
                                    </div>
                                    <h3 class="text-lg font-bold text-white mb-2 group-hover:text-purple-400 transition-colors duration-300">
                                        Pembayaran Aman
                                    </h3>
                                    <p class="text-sm text-gray-400 group-hover:text-gray-300 transition-colors duration-300">
                                        Transaksi aman dengan berbagai metode pembayaran
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 5: Many Options -->
                        <div class="group flex-none w-[300px] snap-center">
                            <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg p-6 border border-gray-700 relative overflow-hidden transition-all duration-500 hover:bg-gray-700/50 hover:border-sky-500 hover:-translate-y-2">
                                <div class="absolute top-0 left-0 w-2 h-0 bg-red-500 transition-all duration-500 group-hover:h-full"></div>
                                <div class="relative">
                                    <div class="w-14 h-14 rounded-lg bg-red-500/10 text-red-500 flex items-center justify-center mb-4 transform transition-all duration-500 group-hover:scale-110 group-hover:rotate-6">
                                        <i class="fas fa-plane text-xl"></i>
                                    </div>
                                    <h3 class="text-lg font-bold text-white mb-2 group-hover:text-red-400 transition-colors duration-300">
                                        Banyak Pilihan
                                    </h3>
                                    <p class="text-sm text-gray-400 group-hover:text-gray-300 transition-colors duration-300">
                                        Berbagai pilihan maskapai dan transportasi
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 6: Points & Rewards -->
                        <div class="group flex-none w-[300px] snap-center">
                            <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg p-6 border border-gray-700 relative overflow-hidden transition-all duration-500 hover:bg-gray-700/50 hover:border-sky-500 hover:-translate-y-2">
                                <div class="absolute top-0 left-0 w-2 h-0 bg-pink-500 transition-all duration-500 group-hover:h-full"></div>
                                <div class="relative">
                                    <div class="w-14 h-14 rounded-lg bg-pink-500/10 text-pink-500 flex items-center justify-center mb-4 transform transition-all duration-500 group-hover:scale-110 group-hover:rotate-6">
                                        <i class="fas fa-gift text-xl"></i>
                                    </div>
                                    <h3 class="text-lg font-bold text-white mb-2 group-hover:text-pink-400 transition-colors duration-300">
                                        Poin & Reward
                                    </h3>
                                    <p class="text-sm text-gray-400 group-hover:text-gray-300 transition-colors duration-300">
                                        Kumpulkan poin dan tukarkan dengan hadiah
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Arrows -->
                        <button 
                            @click="scroll('prev')"
                            class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 bg-white/10 hover:bg-white/20 text-white rounded-full p-3 backdrop-blur-sm transition-all duration-300 group z-10">
                            <i class="fas fa-chevron-left group-hover:-translate-x-1 transition-transform duration-300"></i>
                        </button>
                        <button 
                            @click="scroll('next')"
                            class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 bg-white/10 hover:bg-white/20 text-white rounded-full p-3 backdrop-blur-sm transition-all duration-300 group z-10">
                            <i class="fas fa-chevron-right group-hover:translate-x-1 transition-transform duration-300"></i>
                        </button>

                        <!-- Dots Indicator -->
                        <div class="flex justify-center mt-8 gap-2">
                            <template x-for="(_, index) in [0,1,2]" :key="index">
                                <button 
                                    @click="$refs.carousel.scrollLeft = index * 600"
                                    :class="{'bg-sky-500': activeSlide === index, 'bg-gray-600': activeSlide !== index}"
                                    class="w-2 h-2 rounded-full transition-all duration-300">
                                </button>
                            </template>
                        </div>

                        <script>
                            document.addEventListener('alpine:init', () => {
                                Alpine.data('carousel', () => ({
                                    activeSlide: 0,
                                    init() {
                                        const container = this.$refs.carousel;
                                        container.addEventListener('scroll', () => {
                                            this.activeSlide = Math.floor(container.scrollLeft / 600);
                                        });
                                    }
                                }));
                            });
                        </script>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">MyTickets</h3>
                    <p class="text-gray-400">Your Premium Travel Partner</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Terms & Conditions</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Services</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Flight Tickets</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Train Tickets</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Bus Tickets</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Hotel Booking</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2"></i>
                            support@mytickets.com
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-2"></i>
                            +62 123 456 7890
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} MyTickets. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
