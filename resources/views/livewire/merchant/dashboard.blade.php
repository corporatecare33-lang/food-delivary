<div class="p-6 space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-black text-gray-900">Welcome back, {{ $merchant->business_name }}!</h1>
            <p class="text-gray-500">Here's what's happening with your store today.</p>
        </div>
        <a href="{{ route('merchant.menu') }}" class="bg-primary text-white px-6 py-3 rounded-2xl font-bold shadow-lg shadow-primary/20 hover:bg-primary-dark transition">
            Manage Menu
        </a>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h4 class="text-sm font-bold text-gray-400 uppercase tracking-widest">Today's Orders</h4>
            <p class="text-4xl font-black text-gray-900 mt-2">{{ $stats['today_orders'] }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h4 class="text-sm font-bold text-gray-400 uppercase tracking-widest">Pending</h4>
            <p class="text-4xl font-black text-yellow-600 mt-2">{{ $stats['pending_orders'] }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h4 class="text-sm font-bold text-gray-400 uppercase tracking-widest">Total Sales</h4>
            <p class="text-4xl font-black text-primary mt-2">৳{{ number_format($stats['total_sales'], 0) }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h4 class="text-sm font-bold text-gray-400 uppercase tracking-widest">Items</h4>
            <p class="text-4xl font-black text-gray-900 mt-2">{{ $stats['total_items'] }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Sales Chart -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Sales Overview (7 Days)</h3>
            <div class="h-64">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Top Selling Items -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-900">Top Selling Items</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($top_items as $item)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <img src="{{ $item->menuItem->image }}" class="w-10 h-10 rounded-lg object-cover">
                            <div>
                                <p class="text-sm font-bold text-gray-900">{{ $item->menuItem->name }}</p>
                                <p class="text-xs text-gray-500">{{ $item->total_qty }} units sold</p>
                            </div>
                        </div>
                        <p class="text-sm font-bold text-primary">৳{{ number_format($item->total_sales, 0) }}</p>
                    </div>
                    @empty
                    <p class="text-center text-gray-500 py-4">No sales data yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-900">Recent Orders</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($recent_orders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">#{{ $order->order_number }}</div>
                                <div class="text-xs text-gray-500">{{ $order->customer->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">৳{{ number_format($order->total_amount, 0) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $order->status === 'delivered' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chart_data['labels']),
            datasets: [{
                label: 'Sales (৳)',
                data: @json($chart_data['data']),
                borderColor: '#E24B4A',
                backgroundColor: 'rgba(226, 75, 74, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: false
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