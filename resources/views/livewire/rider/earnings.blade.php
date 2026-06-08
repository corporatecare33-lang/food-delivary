<div class="p-4 lg:p-8 space-y-6">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-gray-900 dark:text-white">Earnings 💰</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Track your income and financial performance</p>
        </div>
    </div>

    <!-- Earnings Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between mb-2">
                <h4 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Today</h4>
                <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="text-3xl font-black text-gray-900 dark:text-white">৳{{ number_format($todayEarnings, 0) }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between mb-2">
                <h4 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Weekly</h4>
                <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="text-3xl font-black text-gray-900 dark:text-white">৳{{ number_format($weeklyEarnings, 0) }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between mb-2">
                <h4 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Monthly</h4>
                <svg class="w-6 h-6 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                </svg>
            </div>
            <p class="text-3xl font-black text-gray-900 dark:text-white">৳{{ number_format($monthlyEarnings, 0) }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between mb-2">
                <h4 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Yearly</h4>
                <svg class="w-6 h-6 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="text-3xl font-black text-gray-900 dark:text-white">৳{{ number_format($yearlyEarnings, 0) }}</p>
        </div>

        <div class="bg-gradient-to-br from-primary to-red-600 rounded-2xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-2">
                <h4 class="text-xs font-bold opacity-90 uppercase">Total</h4>
                <svg class="w-6 h-6 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="text-3xl font-black">৳{{ number_format($totalEarnings, 0) }}</p>
        </div>
    </div>

    <!-- Monthly Earnings Chart -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <div class="mb-6">
            <h3 class="text-lg font-black text-gray-900 dark:text-white">Monthly Earnings Trend</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Last 12 months performance</p>
        </div>
        <canvas id="monthlyEarningsChart" height="80"></canvas>
    </div>

    <!-- Period Filter -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">
            <h3 class="text-lg font-black text-gray-900 dark:text-white">Earnings History</h3>
            <div class="flex space-x-2">
                <button wire:click="setPeriod('today')" 
                        class="px-4 py-2 rounded-lg text-sm font-bold {{ $selectedPeriod === 'today' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }} transition">
                    Today
                </button>
                <button wire:click="setPeriod('week')" 
                        class="px-4 py-2 rounded-lg text-sm font-bold {{ $selectedPeriod === 'week' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }} transition">
                    This Week
                </button>
                <button wire:click="setPeriod('month')" 
                        class="px-4 py-2 rounded-lg text-sm font-bold {{ $selectedPeriod === 'month' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }} transition">
                    This Month
                </button>
                <button wire:click="setPeriod('year')" 
                        class="px-4 py-2 rounded-lg text-sm font-bold {{ $selectedPeriod === 'year' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }} transition">
                    This Year
                </button>
            </div>
        </div>

        <!-- Period Summary -->
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl p-6 mb-6 border border-green-200 dark:border-green-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-gray-700 dark:text-gray-300">Total Earnings for Selected Period</p>
                    <p class="text-4xl font-black text-green-600 dark:text-green-400 mt-2">৳{{ number_format($periodTotal, 0) }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">{{ $periodEarnings->count() }} deliveries completed</p>
                </div>
                <svg class="w-16 h-16 text-green-500 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>

        <!-- Earnings List -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Order ID</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Restaurant</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Order Amount</th>
                        <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Your Earning</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($periodEarnings as $earning)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                            {{ $earning->completed_at->format('M d, Y') }}<br>
                            <span class="text-xs text-gray-500">{{ $earning->completed_at->format('h:i A') }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-primary">#{{ $earning->order->order_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $earning->order->merchant->business_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $earning->order->customer->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">৳{{ number_format($earning->order->total_amount, 0) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-black text-green-600 dark:text-green-400">৳50</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p class="mt-4 text-sm font-bold text-gray-900 dark:text-white">No earnings for this period</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Complete more deliveries to earn!</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Monthly Earnings Chart
    const ctx = document.getElementById('monthlyEarningsChart').getContext('2d');
    const monthlyData = @json($monthlyData);
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: monthlyData.map(item => item.month),
            datasets: [{
                label: 'Monthly Earnings (৳)',
                data: monthlyData.map(item => item.amount),
                backgroundColor: 'rgba(226, 75, 74, 0.8)',
                borderColor: '#E24B4A',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
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
