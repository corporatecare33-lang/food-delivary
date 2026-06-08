<div class="bg-gray-50 min-h-screen pt-20">
    <!-- Merchant Header -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex flex-col md:flex-row gap-8 items-start">
                <div class="w-full md:w-1/3 h-64 rounded-3xl overflow-hidden shadow-lg">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover" alt="{{ $merchant->business_name }}">
                </div>
                <div class="flex-1">
                    <nav class="flex mb-4 text-sm text-gray-500">
                        <a href="/" class="hover:text-primary transition">Home</a>
                        <span class="mx-2">/</span>
                        <span class="text-gray-900 font-semibold">{{ $merchant->business_name }}</span>
                    </nav>
                    <h1 class="text-4xl font-black text-gray-900 mb-4">{{ $merchant->business_name }}</h1>
                    <div class="flex flex-wrap items-center gap-6 text-sm">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <span class="font-bold text-gray-900">4.8</span>
                            <span class="text-gray-500 ml-1">(500+ ratings)</span>
                        </div>
                        <div class="flex items-center text-gray-500">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            25-35 min
                        </div>
                        <div class="flex items-center text-gray-500">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            {{ $merchant->address }}
                        </div>
                    </div>
                    <div class="mt-8 flex gap-4">
                        <button class="bg-primary text-white px-8 py-3 rounded-2xl font-bold shadow-lg shadow-primary/20 hover:bg-primary-dark transition">Order Now</button>
                        <button class="bg-gray-100 text-gray-900 px-8 py-3 rounded-2xl font-bold hover:bg-gray-200 transition">More Info</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Sidebar Navigation -->
            <div class="w-full lg:w-64 flex-shrink-0">
                <div class="sticky top-24 bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-6">Menu Categories</h3>
                    <ul class="space-y-4">
                        @foreach($merchant->menus as $menu)
                        <li>
                            <a href="#menu-{{ $menu->id }}" class="block font-bold text-gray-600 hover:text-primary transition">{{ $menu->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Menu Items -->
            <div class="flex-1 space-y-12">
                @foreach($merchant->menus as $menu)
                <section id="menu-{{ $menu->id }}">
                    <h2 class="text-2xl font-black text-gray-900 mb-8">{{ $menu->name }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($menu->items as $item)
                        <div class="bg-white rounded-3xl p-4 flex gap-4 shadow-sm hover:shadow-md transition border border-gray-100 group cursor-pointer">
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900 group-hover:text-primary transition mb-1">{{ $item->name }}</h4>
                                <p class="text-sm text-gray-500 line-clamp-2 mb-4">{{ $item->description }}</p>
                                <span class="font-black text-gray-900 text-lg">৳{{ number_format($item->price, 0) }}</span>
                            </div>
                            <div class="w-24 h-24 rounded-2xl overflow-hidden flex-shrink-0 relative">
                                <img src="{{ $item->image }}" class="w-full h-full object-cover" alt="{{ $item->name }}">
                                <button class="absolute bottom-1 right-1 bg-primary text-white p-2 rounded-xl shadow-lg hover:scale-110 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endforeach
            </div>

            <!-- Cart Preview (Foodpanda Style) -->
            <div class="w-full lg:w-80 flex-shrink-0">
                <div class="sticky top-24 bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="p-6 bg-primary text-white">
                        <h3 class="font-black text-lg">Your Cart</h3>
                        <p class="text-sm text-white/80">From {{ $merchant->business_name }}</p>
                    </div>
                    <div class="p-8 text-center py-20">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <p class="text-gray-500 font-bold">Your cart is empty</p>
                        <p class="text-xs text-gray-400 mt-2">Add some delicious items to start your order!</p>
                    </div>
                    <div class="p-6 border-t border-gray-100 bg-gray-50">
                        <div class="flex justify-between font-black text-gray-900 mb-6">
                            <span>Total</span>
                            <span>৳0</span>
                        </div>
                        <button class="w-full py-4 bg-gray-200 text-gray-400 font-black rounded-2xl cursor-not-allowed transition">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>