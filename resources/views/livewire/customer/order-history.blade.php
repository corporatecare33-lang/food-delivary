<div class="p-6">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-2xl font-black text-gray-900 mb-8">My Orders</h2>

        <div class="space-y-6">
            @foreach($orders as $order)
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center text-primary font-black">
                            {{ substr($order->merchant->business_name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">{{ $order->merchant->business_name }}</h3>
                            <p class="text-sm text-gray-500">Order #{{ $order->order_number }} • {{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-black text-lg text-gray-900">৳{{ number_format($order->total_amount, 0) }}</div>
                        <span class="px-3 py-1 rounded-full text-xs font-bold 
                            {{ $order->status === 'delivered' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
                
                @if($order->riderAssignment)
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm">
                            🚴
                        </div>
                        <div class="text-sm">
                            <span class="text-gray-500">Rider:</span>
                            <span class="font-bold text-gray-900">{{ $order->riderAssignment->rider->user->name }}</span>
                        </div>
                    </div>
                    <button class="text-xs font-bold text-primary hover:underline tracking-widest uppercase">Track Order</button>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    </div>
</div>