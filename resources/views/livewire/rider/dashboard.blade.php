<div class="p-6 space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-black text-gray-900">Rider Dashboard</h1>
            <p class="text-gray-500">Welcome back! Check your active deliveries.</p>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-sm font-bold text-gray-400">Status:</span>
            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $rider->status === 'idle' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                {{ ucfirst($rider->status) }}
            </span>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h4 class="text-sm font-bold text-gray-400 uppercase tracking-widest">Active Deliveries</h4>
            <p class="text-4xl font-black text-gray-900 mt-2">{{ $stats['active_delivery'] }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h4 class="text-sm font-bold text-gray-400 uppercase tracking-widest">Total Completed</h4>
            <p class="text-4xl font-black text-gray-900 mt-2">{{ $stats['total_completed'] }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h4 class="text-sm font-bold text-gray-400 uppercase tracking-widest">Total Earnings</h4>
            <p class="text-4xl font-black text-primary mt-2">৳{{ number_format($stats['total_earnings'], 0) }}</p>
        </div>
    </div>

    <!-- Active Orders -->
    <div class="space-y-4">
        <h3 class="text-lg font-bold text-gray-900">Active Deliveries</h3>
        @forelse($active_orders as $assignment)
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm font-bold text-primary">#{{ $assignment->order->order_number }}</span>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $assignment->status === 'assigned' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $assignment->status }}
                        </span>
                    </div>
                    <div class="mt-2 space-y-1">
                        <p class="text-sm font-bold text-gray-900">Pick up: {{ $assignment->order->merchant->business_name }}</p>
                        <p class="text-xs text-gray-500">{{ $assignment->order->merchant->address }}</p>
                        <p class="text-sm font-bold text-gray-900 mt-2">Deliver to: {{ $assignment->order->customer->name }}</p>
                        <p class="text-xs text-gray-500">{{ $assignment->order->delivery_address }}</p>
                    </div>
                </div>
                <div class="flex space-x-2">
                    @if($assignment->status === 'assigned')
                        <button wire:click="updateAssignmentStatus({{ $assignment->id }}, 'accepted')" class="bg-primary text-white px-6 py-2 rounded-xl font-bold hover:bg-primary-dark transition text-sm">
                            Accept Order
                        </button>
                    @elseif($assignment->status === 'accepted')
                        <button wire:click="updateAssignmentStatus({{ $assignment->id }}, 'completed')" class="bg-green-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-green-700 transition text-sm">
                            Mark Delivered
                        </button>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white p-10 rounded-2xl shadow-sm border border-gray-100 text-center text-gray-500">
            No active deliveries at the moment.
        </div>
        @endforelse
    </div>

    <!-- Past Deliveries -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-900">Past Deliveries</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Merchant</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Completed At</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Earnings</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($past_orders as $assignment)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">#{{ $assignment->order->order_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $assignment->order->merchant->business_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $assignment->completed_at ? $assignment->completed_at->format('M d, h:i A') : 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-primary">৳50</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
