<div class="p-4 lg:p-8 space-y-6">
    <!-- Flash Messages -->
    @if (session()->has('message'))
    <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl flex items-center justify-between animate-fade-in">
        <span class="font-bold">{{ session('message') }}</span>
        <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
    @endif

    <!-- Header with Online/Offline Toggle -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-gray-900 dark:text-white">Welcome back, {{ auth()->user()->name }}! 👋</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Track your deliveries and earnings in real-time</p>
        </div>
        
        <div class="flex items-center space-x-4">
            <!-- Online/Offline Toggle -->
            <div class="flex items-center bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-2">
                <span class="text-sm font-bold text-gray-700 dark:text-gray-300 mr-3 px-2">Status:</span>
                <button wire:click="toggleOnlineStatus" 
                        class="relative inline-flex items-center h-8 rounded-full w-16 transition {{ $isOnline ? 'bg-green-500' : 'bg-gray-300' }}">
                    <span class="sr-only">Toggle online status</span>
                    <span class="inline-block w-6 h-6 transform transition bg-white rounded-full shadow-lg {{ $isOnline ? 'translate-x-9' : 'translate-x-1' }}"></span>
                </button>
                <span class="ml-3 px-2 font-bold {{ $isOnline ? 'text-green-600' : 'text-gray-500' }}">
                    {{ $isOnline ? 'ONLINE' : 'OFFLINE' }}
                </span>
            </div>

            <!-- Notification Bell -->
            <button class="relative p-3 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                <svg class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                @if($assignedOrders->count() > 0)
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center animate-pulse">
                    {{ $assignedOrders->count() }}
                </span>
                @endif
            </button>
        </div>
    </div>

    <!-- Earnings Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Today's Earnings -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-2">
                <h4 class="text-sm font-bold opacity-90">Today's Earnings</h4>
                <svg class="w-8 h-8 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="text-4xl font-black">৳{{ number_format($todayEarnings, 0) }}</p>
            <p class="text-sm opacity-80 mt-2">{{ $todayDeliveries }} deliveries</p>
        </div>

        <!-- Weekly Earnings -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-2">
                <h4 class="text-sm font-bold opacity-90">Weekly Earnings</h4>
                <svg class="w-8 h-8 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="text-4xl font-black">৳{{ number_format($weeklyEarnings, 0) }}</p>
            <p class="text-sm opacity-80 mt-2">This week</p>
        </div>

        <!-- Monthly Earnings -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-2">
                <h4 class="text-sm font-bold opacity-90">Monthly Earnings</h4>
                <svg class="w-8 h-8 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                </svg>
            </div>
            <p class="text-4xl font-black">৳{{ number_format($monthlyEarnings, 0) }}</p>
            <p class="text-sm opacity-80 mt-2">This month</p>
        </div>

        <!-- Total Lifetime Earnings -->
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-2">
                <h4 class="text-sm font-bold opacity-90">Total Earnings</h4>
                <svg class="w-8 h-8 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="text-4xl font-black">৳{{ number_format($totalEarnings, 0) }}</p>
            <p class="text-sm opacity-80 mt-2">{{ $totalDeliveries }} total deliveries</p>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Active Orders</p>
                    <p class="text-2xl font-black text-gray-900 dark:text-white mt-1">{{ $activeOrders }}</p>
                </div>
                <div class="bg-blue-100 dark:bg-blue-900/30 rounded-lg p-3">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Acceptance Rate</p>
                    <p class="text-2xl font-black text-green-600 dark:text-green-400 mt-1">{{ $acceptanceRate }}%</p>
                </div>
                <div class="bg-green-100 dark:bg-green-900/30 rounded-lg p-3">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Completion Rate</p>
                    <p class="text-2xl font-black text-purple-600 dark:text-purple-400 mt-1">{{ $completionRate }}%</p>
                </div>
                <div class="bg-purple-100 dark:bg-purple-900/30 rounded-lg p-3">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Available Balance</p>
                    <p class="text-2xl font-black text-primary dark:text-primary mt-1">৳{{ number_format($rider->current_balance ?? 0, 0) }}</p>
                </div>
                <div class="bg-red-100 dark:bg-red-900/30 rounded-lg p-3">
                    <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings Chart -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-black text-gray-900 dark:text-white">Weekly Earnings Overview</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Last 7 days performance</p>
            </div>
        </div>
        <canvas id="earningsChart" height="80"></canvas>
    </div>

    <!-- Orders Tabs -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <!-- Tab Navigation -->
        <div class="border-b border-gray-200 dark:border-gray-700">
            <nav class="flex overflow-x-auto" aria-label="Tabs">
                <button wire:click="setTab('assigned')" 
                        class="px-6 py-4 text-sm font-bold border-b-2 {{ $currentTab === 'assigned' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} transition whitespace-nowrap">
                    Assigned ({{ $assignedOrders->count() }})
                </button>
                <button wire:click="setTab('accepted')" 
                        class="px-6 py-4 text-sm font-bold border-b-2 {{ $currentTab === 'accepted' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} transition whitespace-nowrap">
                    Accepted ({{ $acceptedOrders->count() }})
                </button>
                <button wire:click="setTab('picked')" 
                        class="px-6 py-4 text-sm font-bold border-b-2 {{ $currentTab === 'picked' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} transition whitespace-nowrap">
                    Picked Up ({{ $pickedOrders->count() }})
                </button>
                <button wire:click="setTab('delivery')" 
                        class="px-6 py-4 text-sm font-bold border-b-2 {{ $currentTab === 'delivery' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} transition whitespace-nowrap">
                    In Delivery ({{ $inDeliveryOrders->count() }})
                </button>
                <button wire:click="setTab('completed')" 
                        class="px-6 py-4 text-sm font-bold border-b-2 {{ $currentTab === 'completed' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} transition whitespace-nowrap">
                    Completed ({{ $completedOrders->count() }})
                </button>
                <button wire:click="setTab('cancelled')" 
                        class="px-6 py-4 text-sm font-bold border-b-2 {{ $currentTab === 'cancelled' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} transition whitespace-nowrap">
                    Cancelled ({{ $cancelledOrders->count() }})
                </button>
            </nav>
        </div>

        <!-- Tab Content -->
        <div class="p-6">
            @if($currentTab === 'assigned' || $currentTab === 'overview')
                @forelse($assignedOrders as $assignment)
                    @include('livewire.rider.partials.order-card', ['assignment' => $assignment, 'status' => 'assigned'])
                @empty
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <h3 class="mt-4 text-lg font-bold text-gray-900 dark:text-white">No assigned orders</h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">You're all caught up! New orders will appear here.</p>
                    </div>
                @endforelse
            @endif

            @if($currentTab === 'accepted')
                @forelse($acceptedOrders as $assignment)
                    @include('livewire.rider.partials.order-card', ['assignment' => $assignment, 'status' => 'accepted'])
                @empty
                    <div class="text-center py-12">
                        <p class="text-gray-500 dark:text-gray-400">No accepted orders</p>
                    </div>
                @endforelse
            @endif

            @if($currentTab === 'picked')
                @forelse($pickedOrders as $assignment)
                    @include('livewire.rider.partials.order-card', ['assignment' => $assignment, 'status' => 'picked_up'])
                @empty
                    <div class="text-center py-12">
                        <p class="text-gray-500 dark:text-gray-400">No picked up orders</p>
                    </div>
                @endforelse
            @endif

            @if($currentTab === 'delivery')
                @forelse($inDeliveryOrders as $assignment)
                    @include('livewire.rider.partials.order-card', ['assignment' => $assignment, 'status' => 'in_delivery'])
                @empty
                    <div class="text-center py-12">
                        <p class="text-gray-500 dark:text-gray-400">No orders in delivery</p>
                    </div>
                @endforelse
            @endif

            @if($currentTab === 'completed')
                @forelse($completedOrders as $assignment)
                    @include('livewire.rider.partials.order-card', ['assignment' => $assignment, 'status' => 'completed'])
                @empty
                    <div class="text-center py-12">
                        <p class="text-gray-500 dark:text-gray-400">No completed orders</p>
                    </div>
                @endforelse
            @endif

            @if($currentTab === 'cancelled')
                @forelse($cancelledOrders as $assignment)
                    @include('livewire.rider.partials.order-card', ['assignment' => $assignment, 'status' => 'rejected'])
                @empty
                    <div class="text-center py-12">
                        <p class="text-gray-500 dark:text-gray-400">No cancelled orders</p>
                    </div>
                @endforelse
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Earnings Chart
    const ctx = document.getElementById('earningsChart').getContext('2d');
    const earningsData = @json($dailyEarnings);
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: earningsData.map(item => item.date),
            datasets: [{
                label: 'Daily Earnings (৳)',
                data: earningsData.map(item => item.amount),
                borderColor: '#E24B4A',
                backgroundColor: 'rgba(226, 75, 74, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: '#E24B4A',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointHoverRadius: 7,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: '#E24B4A',
                    borderWidth: 1,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return '৳' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '৳' + value;
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endpush
