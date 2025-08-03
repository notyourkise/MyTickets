<!-- Partner Logo Scroller Component -->
<div class="relative w-full bg-white overflow-hidden py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center text-gray-800 mb-12">Mitra Kami</h2>
        <p class="text-lg text-gray-600 text-center mb-20 max-w-3xl mx-auto leading-relaxed">Kami bekerja sama dengan berbagai maskapai, hotel, dan penyedia layanan transportasi terkemuka untuk memberikan Anda pilihan terbaik</p>
        
        <!-- Logo Scroller Container -->
        <div class="relative w-full overflow-hidden pb-20">
            <!-- First Set of Logos -->
            <div class="flex space-x-16 animate-scroll">
                @foreach ($partnerLogos as $logo)
                    <div class="flex-none w-36 h-24 bg-white shadow-lg rounded-xl p-6 hover:shadow-xl transition-all duration-300 flex items-center justify-center group hover:-translate-y-1">
                        <img 
                            src="{{ asset($logo['path']) }}" 
                            alt="{{ $logo['alt'] }}"
                            class="max-h-full max-w-full object-contain opacity-70 group-hover:opacity-100 transition-all duration-300 transform group-hover:scale-110"
                        >
                    </div>
                @endforeach
                
                <!-- Duplicate Set for Seamless Scrolling -->
                @foreach ($partnerLogos as $logo)
                    <div class="flex-none w-40 h-24 bg-white shadow-lg rounded-xl p-6 hover:shadow-xl transition-all duration-300 flex items-center justify-center group hover:-translate-y-1">
                        <img 
                            src="{{ asset($logo['path']) }}" 
                            alt="{{ $logo['alt'] }}"
                            class="max-h-full max-w-full object-contain opacity-70 group-hover:opacity-100 transition-all duration-300 transform group-hover:scale-110"
                        >
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <!-- Gradient Overlays -->
    <div class="absolute left-0 top-0 bottom-0 w-32 bg-gradient-to-r from-white to-transparent"></div>
    <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-white to-transparent"></div>
</div>

<style>
@keyframes scroll {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

.animate-scroll {
    animation: scroll 60s linear infinite;
    &:hover {
        animation-play-state: paused;
    }
}
</style>
