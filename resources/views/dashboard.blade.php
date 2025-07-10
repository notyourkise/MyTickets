<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600">Selamat datang, {{ Auth::user()->name }}!</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Message -->
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <strong>Selamat!</strong> Akun Anda berhasil diverifikasi dan Anda sudah login.
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Selamat Datang di MyTickets!</h3>
                    <p class="mb-4">Platform pemesanan tiket transportasi dan hotel online terpercaya.</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                        <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-blue-800">Tiket Pesawat</h4>
                            </div>
                            <p class="text-blue-600 text-sm">Pesan tiket pesawat ke berbagai destinasi domestik dan internasional</p>
                            <button class="mt-4 w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition-colors">
                                Cari Penerbangan
                            </button>
                        </div>
                        
                        <div class="bg-green-50 p-6 rounded-lg border border-green-200 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z"/>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-green-800">Tiket Bus</h4>
                            </div>
                            <p class="text-green-600 text-sm">Reservasi tiket bus antar kota dengan berbagai kelas kenyamanan</p>
                            <button class="mt-4 w-full bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition-colors">
                                Cari Bus
                            </button>
                        </div>
                        
                        <div class="bg-purple-50 p-6 rounded-lg border border-purple-200 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-purple-800">Tiket Kereta</h4>
                            </div>
                            <p class="text-purple-600 text-sm">Booking tiket kereta api untuk perjalanan yang nyaman dan aman</p>
                            <button class="mt-4 w-full bg-purple-500 text-white py-2 px-4 rounded hover:bg-purple-600 transition-colors">
                                Cari Kereta
                            </button>
                        </div>
                        
                        <div class="bg-yellow-50 p-6 rounded-lg border border-yellow-200 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-yellow-800">Hotel</h4>
                            </div>
                            <p class="text-yellow-600 text-sm">Cari dan pesan hotel terbaik untuk akomodasi perjalanan Anda</p>
                            <button class="mt-4 w-full bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600 transition-colors">
                                Cari Hotel
                            </button>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg text-center">
                            <div class="text-2xl font-bold text-gray-800">24/7</div>
                            <div class="text-sm text-gray-600">Customer Support</div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg text-center">
                            <div class="text-2xl font-bold text-gray-800">100+</div>
                            <div class="text-sm text-gray-600">Destinasi</div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg text-center">
                            <div class="text-2xl font-bold text-gray-800">99.9%</div>
                            <div class="text-sm text-gray-600">Success Rate</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
