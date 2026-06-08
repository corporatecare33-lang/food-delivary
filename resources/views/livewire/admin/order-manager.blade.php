<div>
    <div class="bg-white shadow rounded-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-900">Order Management</h3>
        </div>

        @if (session()->has('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 mx-6 mt-4" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rider</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($orders as $order)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">#{{ $order->order_number }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <div class="font-bold text-gray-900">{{ $order->customer->name }}</div>
                            <div>{{ $order->merchant->business_name }}</div>
                            <div class="text-primary font-bold">৳{{ number_format($order->total_amount, 2) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select wire:change="updateStatus({{ $order->id }}, $event.target.value)" 
                                    class="text-xs rounded-lg border-gray-300 focus:ring-primary focus:border-primary">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>Preparing</option>
                                <option value="on_the_way" {{ $order->status === 'on_the_way' ? 'selected' : '' }}>On the Way</option>
                                <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <livewire:admin.assign-rider :orderId="$order->id" :key="'assign-'.$order->id" />
                            <div class="mt-1 text-xs text-gray-400">
                                Current: {{ $order->riderAssignment->rider->user->name ?? 'None' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button wire:click="viewDetails({{ $order->id }})" class="text-primary hover:text-primary-dark">View Details</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $orders->links() }}
        </div>
    </div>

    <!-- Order Details Modal -->
    @if($showDetails && $selectedOrder)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" wire:click="closeDetails"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 flex justify-between" id="modal-title">
                                <span>Order Details #{{ $selectedOrder->order_number }}</span>
                                <button wire:click="closeDetails" class="text-gray-400 hover:text-gray-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </h3>
                            <div class="mt-4 border-t border-gray-100 pt-4">
                                <div class="grid grid-cols-2 gap-4 mb-6">
                                    <div>
                                        <h4 class="text-xs font-bold text-gray-400 uppercase">Customer</h4>
                                        <p class="text-sm font-medium">{{ $selectedOrder->customer->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $selectedOrder->customer->email }}</p>
                                        <p class="text-sm text-gray-500">{{ $selectedOrder->customer->mobile }}</p>
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-bold text-gray-400 uppercase">Merchant</h4>
                                        <p class="text-sm font-medium">{{ $selectedOrder->merchant->business_name }}</p>
                                        <p class="text-sm text-gray-500">{{ $selectedOrder->merchant->address }}</p>
                                    </div>
                                </div>

                                <div class="mb-6">
                                    <h4 class="text-xs font-bold text-gray-400 uppercase mb-2">Items</h4>
                                    <table class="min-w-full divide-y divide-gray-100">
                                        <thead>
                                            <tr>
                                                <th class="text-left text-xs font-medium text-gray-500 uppercase">Item</th>
                                                <th class="text-center text-xs font-medium text-gray-500 uppercase">Qty</th>
                                                <th class="text-right text-xs font-medium text-gray-500 uppercase">Price</th>
                                                <th class="text-right text-xs font-medium text-gray-500 uppercase">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100">
                                            @foreach($selectedOrder->items as $item)
                                            <tr>
                                                <td class="py-2 text-sm text-gray-900">{{ $item->menuItem->name }}</td>
                                                <td class="py-2 text-sm text-gray-900 text-center">{{ $item->quantity }}</td>
                                                <td class="py-2 text-sm text-gray-900 text-right">৳{{ number_format($item->price, 2) }}</td>
                                                <td class="py-2 text-sm text-gray-900 text-right">৳{{ number_format($item->total, 2) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="border-t border-gray-100 pt-4 space-y-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Subtotal</span>
                                        <span class="text-gray-900">৳{{ number_format($selectedOrder->subtotal, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Delivery Fee</span>
                                        <span class="text-gray-900">৳{{ number_format($selectedOrder->delivery_fee, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Tax</span>
                                        <span class="text-gray-900">৳{{ number_format($selectedOrder->tax, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between text-lg font-bold border-t border-gray-100 pt-2">
                                        <span class="text-gray-900">Total</span>
                                        <span class="text-primary">৳{{ number_format($selectedOrder->total_amount, 2) }}</span>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <h4 class="text-xs font-bold text-gray-400 uppercase">Delivery Address</h4>
                                    <p class="text-sm text-gray-600 mt-1">{{ $selectedOrder->delivery_address }}</p>
                                </div>
                                
                                @if($selectedOrder->notes)
                                <div class="mt-4">
                                    <h4 class="text-xs font-bold text-gray-400 uppercase">Notes</h4>
                                    <p class="text-sm text-gray-600 mt-1 italic">"{{ $selectedOrder->notes }}"</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" wire:click="closeDetails" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>