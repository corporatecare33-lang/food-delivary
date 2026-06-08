<div>
    <!-- Hero Section -->
    <section class="relative bg-white pt-32 pb-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 tracking-tight mb-6">
                    What are you <span class="text-primary">craving</span> today?
                </h1>
                <p class="text-xl text-gray-500 max-w-2xl mx-auto mb-10">
                    Order from the best local restaurants and get your food delivered fresh to your doorstep.
                </p>

                <!-- Search Bar -->
                <div class="max-w-3xl mx-auto relative group">
                    <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                        <svg class="h-6 w-6 text-gray-400 group-focus-within:text-primary transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" 
                           wire:model.live.debounce.300ms="search"
                           placeholder="Search for restaurants or dishes..." 
                           class="block w-full pl-16 pr-4 py-5 border-2 border-gray-100 rounded-2xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary sm:text-lg transition shadow-xl shadow-gray-100">
                    <button class="absolute right-3 top-3 bottom-3 bg-primary text-white px-8 rounded-xl font-bold hover:bg-primary-dark transition shadow-lg shadow-primary/20">
                        Search
                    </button>
                </div>
                
                <!-- Popular Tags -->
                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    <span class="px-4 py-2 bg-gray-100 rounded-full text-sm font-medium text-gray-600 cursor-pointer hover:bg-primary/10 hover:text-primary transition">Biriyani</span>
                    <span class="px-4 py-2 bg-gray-100 rounded-full text-sm font-medium text-gray-600 cursor-pointer hover:bg-primary/10 hover:text-primary transition">Burgers</span>
                    <span class="px-4 py-2 bg-gray-100 rounded-full text-sm font-medium text-gray-600 cursor-pointer hover:bg-primary/10 hover:text-primary transition">Pizza</span>
                    <span class="px-4 py-2 bg-gray-100 rounded-full text-sm font-medium text-gray-600 cursor-pointer hover:bg-primary/10 hover:text-primary transition">Sushi</span>
                </div>
            </div>
        </div>
        
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-96 h-96 bg-primary/5 rounded-full blur-3xl"></div>
    </section>

    <!-- Lunch Items Section -->
    <section class="py-16 bg-gray-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Lunch Specials</h2>
                    <p class="text-gray-500 mt-1">Quick and delicious meals for your lunch break</p>
                </div>
                <div class="flex space-x-2">
                    <button class="swiper-button-prev-custom p-2 rounded-full border border-gray-200 bg-white text-gray-400 hover:text-primary hover:border-primary transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button class="swiper-button-next-custom p-2 rounded-full border border-gray-200 bg-white text-gray-400 hover:text-primary hover:border-primary transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>

            <div class="swiper lunch-swiper">
                <div class="swiper-wrapper">
                    @foreach($lunchItems as $item)
                    <div class="swiper-slide">
                        <a href="{{ route('merchant.details', $item->menu->merchant->slug) }}" class="block bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group h-full">
                            <div class="relative h-52 overflow-hidden">
                                <img src="{{ $item->image }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-primary font-bold shadow-sm">
                                    ৳{{ number_format($item->price, 0) }}
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center text-xs font-semibold text-primary uppercase tracking-wider mb-2">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    {{ $item->menu->merchant->business_name }}
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-primary transition">{{ $item->name }}</h3>
                                <p class="text-gray-500 text-sm line-clamp-2 mb-4">{{ $item->description }}</p>
                                <div class="w-full py-3 bg-gray-50 text-gray-900 text-center font-bold rounded-xl hover:bg-primary hover:text-white transition group-hover:shadow-lg group-hover:shadow-primary/20">
                                    Order Now
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('livewire:navigated', () => {
            new Swiper('.lunch-swiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                navigation: {
                    nextEl: '.swiper-button-next-custom',
                    prevEl: '.swiper-button-prev-custom',
                },
                breakpoints: {
                    640: { slidesPerView: 2 },
                    1024: { slidesPerView: 4 },
                },
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
            });
        });
    </script>

    <!-- Merchants Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Featured Merchants</h2>
                    <p class="text-gray-500 mt-1">The best kitchens around you</p>
                </div>
                <a href="#" class="text-primary font-bold hover:underline">View all</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($merchants as $merchant)
                <div class="group cursor-pointer">
                    <div class="relative h-64 rounded-3xl overflow-hidden mb-4">
                        <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&q=80&w=800" alt="{{ $merchant->business_name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-6">
                            <span class="text-white font-bold text-lg">Order Now</span>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-primary transition">{{ $merchant->business_name }}</h3>
                    <div class="flex items-center mt-2 text-sm text-gray-500">
                        <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <span class="font-bold text-gray-900">4.8</span>
                        <span class="mx-2">•</span>
                        <span>25-35 min</span>
                        <span class="mx-2">•</span>
                        <span>৳50 Delivery</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- App CTA -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-primary rounded-[3rem] p-12 md:p-20 flex flex-col md:flex-row items-center justify-between relative overflow-hidden">
                <div class="max-w-xl z-10 text-center md:text-left text-white">
                    <h2 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight">
                        Enjoy your favorite food <br> on the go.
                    </h2>
                    <p class="text-xl text-white/80 mb-10">
                        Get the Foosto app for faster ordering and exclusive mobile-only deals.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="#" class="bg-black text-white px-8 py-4 rounded-2xl font-bold flex items-center justify-center hover:bg-gray-900 transition shadow-2xl">
                            <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M17.523 15.341c-.551 0-1.127.47-1.127 1.054 0 .584.576 1.053 1.127 1.053.551 0 1.128-.469 1.128-1.053 0-.584-.577-1.054-1.128-1.054zm-9.046 0c-.551 0-1.127.47-1.127 1.054 0 .584.576 1.053 1.127 1.053.551 0 1.128-.469 1.128-1.053 0-.584-.577-1.054-1.128-1.054zm13.141-5.362l-2.183-3.778a1.05 1.05 0 00-1.432-.387l-1.053.608c-.787-.492-1.638-.87-2.541-1.12V3.106c0-.584-.473-1.053-1.054-1.053h-2.106c-.581 0-1.054.469-1.054 1.053v2.247c-.903.25-1.754.628-2.541 1.12l-1.053-.608a1.05 1.05 0 00-1.432.387L3.38 9.979a1.05 1.05 0 00.387 1.432l1.053.608c-.027.24-.04.484-.04.731 0 .247.013.491.04.731l-1.053.608a1.05 1.05 0 00-.387 1.432l2.183 3.778c.287.496.918.666 1.432.387l1.053-.608c.787.492 1.638.87 2.541 1.12v2.247c0 .584.473 1.053 1.054 1.053h2.106c.581 0 1.054-.469 1.054-1.053v-2.247c.903-.25 1.754-.628 2.541-1.12l1.053.608a1.05 1.05 0 001.432-.387l2.183-3.778a1.05 1.05 0 00-.387-1.432l-1.053-.608c.027-.24.04-.484.04-.731 0-.247-.013-.491-.04-.731l1.053-.608a1.05 1.05 0 00.387-1.432z"/></svg>
                            App Store
                        </a>
                        <a href="#" class="bg-black text-white px-8 py-4 rounded-2xl font-bold flex items-center justify-center hover:bg-gray-900 transition shadow-2xl">
                            <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M3 20.5v-17c0-.8.7-1.5 1.5-1.5h15c.8 0 1.5.7 1.5 1.5v17c0 .8-.7 1.5-1.5 1.5h-15c-.8 0-1.5-.7-1.5-1.5zm2-16.5v16h14v-16h-14zm7 11c-1.7 0-3-1.3-3-3s1.3-3 3-3 3 1.3 3 3-1.3 3-3 3zm0-4c-.6 0-1 .4-1 1s.4 1 1 1 1-.4 1-1-.4-1-1-1z"/></svg>
                            Play Store
                        </a>
                    </div>
                </div>
                <div class="absolute right-0 bottom-0 translate-y-1/4 hidden lg:block opacity-20">
                    <span class="text-[400px]">🍔</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-2 md:col-span-1">
                    <a href="/" class="text-3xl font-bold text-white mb-6 block">Foosto</a>
                    <p class="mb-6 leading-relaxed">Connecting you with the best local kitchens in Bangladesh. Fresh food, delivered fast.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary hover:text-white transition">FB</a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary hover:text-white transition">IG</a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary hover:text-white transition">TW</a>
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-6 uppercase tracking-wider text-sm">Foosto</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="#" class="hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-6 uppercase tracking-wider text-sm">Partners</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="#" class="hover:text-white transition">Become a Merchant</a></li>
                        <li><a href="#" class="hover:text-white transition">Become a Rider</a></li>
                        <li><a href="#" class="hover:text-white transition">Partner Dashboard</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-6 uppercase tracking-wider text-sm">Support</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="#" class="hover:text-white transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition">Refund Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center text-xs">
                <p>&copy; {{ date('Y') }} Foosto. Developed with ❤️ for food lovers.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <img src="https://foosto.com/assets/images/payments.png" alt="Payment Methods" class="h-6 opacity-50 grayscale hover:grayscale-0 transition cursor-pointer">
                </div>
            </div>
        </div>
    </footer>
</div>