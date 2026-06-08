<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Foosto - Best Food Delivery in Bangladesh</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        body {
            font-family: 'Hind Siliguri', sans-serif;
        }
    </style>
    @livewireStyles
</head>
<body class="bg-white antialiased">
    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-lg border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="/" class="text-3xl font-black text-primary tracking-tighter">Foosto</a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-600 hover:text-primary transition font-bold text-sm uppercase tracking-widest">Offers</a>
                    <a href="#" class="text-gray-600 hover:text-primary transition font-bold text-sm uppercase tracking-widest">Restaurants</a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-900 font-bold text-sm uppercase tracking-widest bg-gray-100 px-6 py-2 rounded-full hover:bg-gray-200 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary transition font-bold text-sm uppercase tracking-widest">Login</a>
                        <a href="{{ route('register') }}" class="bg-primary text-white px-8 py-3 rounded-2xl font-bold text-sm uppercase tracking-widest hover:bg-primary-dark transition shadow-xl shadow-primary/30">Join Now</a>
                    @endauth
                </div>
                <div class="md:hidden flex items-center">
                    <button class="text-gray-900 p-2">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <livewire:home-page />

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @livewireScripts
</body>
</html>